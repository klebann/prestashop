<div class="min-shipping-box">
    {if isset($no_shipping) && $no_shipping}
        <strong>{l s='Brak dostępnej metody dostawy dla tego produktu.' mod='minshipping'}</strong>
    {else}
        <strong>{l s='Najniższy koszt dostawy:' mod='minshipping'}</strong>

        <span style="font-weight:bold">
            {$price|escape:'htmlall':'UTF-8'} {$currency|escape:'htmlall':'UTF-8'}
        </span>

        <br>

        <small style="display:block; margin-top:5px; border: 1px solid black;">
            {l s='Źródło:' mod='minshipping'} <b>{$carrier.name|escape:'htmlall':'UTF-8'}</b> (ID: {$carrier.id|intval})<br>
            {l s='Waga produktu:' mod='minshipping'} {$carrier.weight|escape:'htmlall':'UTF-8'} kg
        </small>
    {/if}
</div>