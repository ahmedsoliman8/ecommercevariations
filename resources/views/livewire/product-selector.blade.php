<div class="space-y-6">
    @if($initialVariation)
        <livewire:product-dropdown :variations="$initialVariation"/>
    @endif
    @if($this->skuVariant)
        <div class="space-y-6">
            <div class="font-semibold text-lg">
                {{$this->skuVariant->formattedPrice()}}
            </div>
            <x-button wire:click.prevent="addToCart">Add to cart</x-button>
        </div>
    @endif
</div>
