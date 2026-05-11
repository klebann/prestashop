<div class="min-shipping-box">
    <strong>{l s='Najniższy koszt dostawy:' mod='minshipping'}</strong>

    <span style="font-weight:bold">
        {$price} {$currency}
    </span>

    <br>

    <small style="display:block; margin-top:5px; border: 1px solid black;">
        {l s='Źródło:' mod='minshipping'} <b>{$carrier.name}</b> (ID: {$carrier.id})<br>
        {l s='Waga produktu:' mod='minshipping'} {$carrier.weight} kg
    </small>
</div>