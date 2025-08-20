<div x-data class="space-y-3">
    <p wire:stream="output">{{ $output }}</p> 
    <div class="relative">
        <input x-ref="prompt" type="text" placeholder="Send a message" class="flex-1 py-2 px-3 rounded-md border border-stone-300 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"  autofocus>
        <button wire:click="submit($refs.prompt.value)" class="p-2 py-1.5 rounded bg-blue-500 text-white w-9 top-1 -mt-px absolute right-1">⌲</button>
    </div>
</div>