<div style="text-align: center">
    <button class="bg-gray-200 px-6 py-4 rounded-full hover:bg-slate-300" wire:click="increment">+</button>
    <button class="bg-gray-200 px-6 py-4 rounded-full hover:bg-slate-300" wire:click="decrement">-</button>


    <h1 class="text-2xl">{{ $count }}</h1>
</div>