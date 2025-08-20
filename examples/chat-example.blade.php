<?php

use Livewire\Volt\Component;

new class extends Component {
    public $prompt = '';
    public $isStreaming = false;
    public $messages = [];

    public function submit()
    {
        $this->messages[] = ['type' => 'user', 'content' => $this->pull('prompt')];
        $this->messages[] = ['type' => 'assistant', 'content' => ''];
        $this->isStreaming = true;
        $this->js('$wire.streamResponse()');
    }

    public function streamResponse()
    {
        $this->messages = ai($this->messages, function($stream) {
            $this->stream('messages.' . count($this->messages) . '.content', $stream, true);
        });
        $this->isStreaming = false;
    }
}; ?>

<div class="space-y-3">
    @if(count($messages) > 0)
        <div class="space-y-4 max-h-96 overflow-y-auto border border-stone-200 rounded-md p-4">
            @foreach($messages as $index => $message)
                <div class="space-y-2">
                    @if($message['type'] === 'user')
                        <div class="flex justify-end">
                            <div class="bg-blue-500 text-white px-4 py-2 rounded-lg max-w-xs lg:max-w-md">
                                <p class="text-sm font-medium mb-1">You</p>
                                <p>{{ $message['content'] }}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-start">
                            <div class="bg-gray-100 px-4 py-2 rounded-lg max-w-xs lg:max-w-md">
                                <p class="text-sm font-medium mb-1 text-gray-700">Assistant</p>
                                <p wire:stream="messages.{{ $index + 1 }}.content">{{ $message['content'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <form wire:submit="submit" class="space-y-2">
        <div class="flex space-x-2">
            <input wire:model="prompt" type="text" placeholder="Type your message..." class="flex-1 py-2 px-3 rounded-md border border-stone-300 focus:outline-none focus:ring-2 focus:ring-blue-500" autofocus />
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed">
                @if($isStreaming)
                    <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                @else
                    Send
                @endif
            </button>
        </div>
    </form>
</div>
