<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Displays the minimum shipping cost on the product page.
 *
 * @author  Jakub Kleban
 * @version 1.0.0
 */
class MinShipping extends Module
{
    public function __construct()
    {
        $this->name = 'minshipping';
        $this->tab = 'shipping_logistics';
        $this->version = '1.0.0';
        $this->author = 'Jakub Kleban';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Min Shipping Cost');
        $this->description = $this->l('Displays minimum shipping cost on product page.');
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayProductAdditionalInfo');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    /**
     * Returns the cheapest available carrier for the given product.
     *
     * @param int $idProduct
     * @param int $idProductAttribute
     *
     * @return array{price: float|null, carrier: array|null}|array{error: string}
     */
    private function getMinimalShippingCost($idProduct, $idProductAttribute = 0)
    {
        $context = $this->context;

        $idCustomer = (int)$context->customer->id;
        if (!$idCustomer) {
            return ['error' => $this->l('Musisz być zalogowany lub mieć adres dostawy.')];
        }

        $idAddress = (int)$context->cart->id_address_delivery;
        if (!$idAddress) {
            $idAddress = (int)Address::getFirstCustomerAddressId($idCustomer);
        }

        if (!$idAddress) {
            return ['error' => $this->l('Brak adresu dostawy w koncie klienta.')];
        }

        $cart = new Cart();
        $cart->id_currency = $context->currency->id;
        $cart->id_lang = $context->language->id;
        $cart->id_customer = $idCustomer;
        $cart->id_address_delivery = $idAddress;
        $cart->id_address_invoice = $idAddress;

        if (!$cart->add()) {
            return ['error' => $this->l('Nie udało się przygotować koszyka do kalkulacji dostawy.')];
        }

        $updateResult = $cart->updateQty(1, (int)$idProduct, (int)$idProductAttribute);
        if (!$updateResult || (int)$updateResult < 0) {
            $cart->delete();
            return ['error' => $this->l('Nie udało się dodać produktu do kalkulacji dostawy.')];
        }

        $product = new Product((int)$idProduct);
        $weight = (float)$product->weight;

        $minPrice = null;
        $bestCarrier = null;

        $carriers = Carrier::getCarriers(
            $context->language->id,
            true,
            false,
            false,
            null,
            Carrier::ALL_CARRIERS
        );

        try {
            foreach ($carriers as $data) {
                try {
                    $carrier = new Carrier($data['id_carrier']);

                    if ($carrier->max_weight > 0 && $weight > $carrier->max_weight) {
                        continue;
                    }

                    $price = $cart->getPackageShippingCost((int)$carrier->id);

                    // Pomijamy darmowe metody (np. odbiór osobisty), pokazujemy tylko płatną dostawę.
                    if ($price === false || $price === null || (float)$price <= 0) {
                        continue;
                    }

                    if ($minPrice === null || (float)$price < $minPrice) {
                        $minPrice = (float)$price;
                        $bestCarrier = [
                            'id' => $carrier->id,
                            'name' => $carrier->name,
                            'price' => (float)$price,
                            'weight' => $weight
                        ];
                    }

                } catch (Exception $e) {
                    continue;
                }
            }
        } finally {
            // Tymczasowy koszyk służy tylko do kalkulacji i nie powinien zostawać w bazie.
            $cart->delete();
        }

        return [
            'price' => $minPrice,
            'carrier' => $bestCarrier
        ];
    }

    /**
     * Renders the minimum shipping cost block on the product page.
     *
     * @param array $params
     *
     * @return string
     */
    public function hookDisplayProductAdditionalInfo($params)
    {
        $product = $params['product'] ?? null;
        $idProduct = (int)($product['id_product'] ?? $product->id_product ?? $product->id ?? 0);

        if (!$idProduct) {
            return '';
        }

        $result = $this->getMinimalShippingCost($idProduct);

        if (isset($result['error'])) {
            $this->context->smarty->assign([
                'error_message' => $result['error']
            ]);

            return $this->display(__FILE__, 'views/templates/hook/minshipping_error.tpl');
        }

        if ($result['price'] === null) {
            $this->context->smarty->assign([
                'no_shipping' => true
            ]);

            return $this->display(__FILE__, 'views/templates/hook/minshipping.tpl');
        }

        $this->context->smarty->assign([
            'price' => number_format($result['price'], 2, '.', ' '),
            'currency' => $this->context->currency->iso_code,
            'carrier' => $result['carrier']
        ]);

        return $this->display(__FILE__, 'views/templates/hook/minshipping.tpl');
    }
}