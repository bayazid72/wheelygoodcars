<div>
    <!-- Your HTML goes here -->
    <button wire:click="changeStatus">
        @if ($car->sold_at)
            Mark as available
        @else
            Mark as sold
        @endif
    </button>
</div>
