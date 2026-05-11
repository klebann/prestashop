<div class="min-shipping-box">
    <strong>{l s='Najniższy koszt dostawy:' mod='minshipping'}</strong>

    {if $minshipping_no_offer}
        <span>{l s='Brak dostępnych opcji dostawy.' mod='minshipping'}</span>
    {else}
        <span style="font-weight:bold">
            {$minshipping_price}
        </span>

        <br>

        <small style="display:block; margin-top:5px; border: 1px solid black;">
            {l s='Źródło:' mod='minshipping'} <b>{$minshipping_carrier.name}</b> (ID: {$minshipping_carrier.id})<br>
        </small>
    {/if}
</div>
