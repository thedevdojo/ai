<?php

use Livewire\Volt\Component;

new class extends Component {
    public $output = '';
 
    public function submit($input)
    {
        $this->output = ai($input, function($chunk){
            $this->stream('output', $chunk, true);
        });
    }
}; ?>

<div x-data class="space-y-3">
    <p wire:stream="output">{{ $output }}</p> 
    <form wire:submit="submit($refs.prompt.value)" class="relative">
        <input x-ref="prompt" type="text" placeholder="Send a message" class="flex-1 py-2 px-3 rounded-md border border-stone-300 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"  autofocus>
        <button type="submit" class="w-9 h-9 flex items-center justify-center rounded bg-blue-500 text-xl text-white top-1 -mt-px absolute right-1">
            <svg wire:loading wire:target="submit" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            <span wire:loading.remove wire:target="submit">⌲</span>
        </button>
    </form>
</div>
