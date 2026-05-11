<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

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

    public function hookDisplayProductAdditionalInfo($params)
    {
        $product = $params['product'] ?? null;

        if (!$product) {
            return '';
        }

        return '<div class="min-shipping-box">
                    Najniższy koszt dostawy: <strong>do wyliczenia</strong>
                </div>';
    }
}