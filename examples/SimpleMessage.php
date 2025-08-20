<?php

namespace App\Livewire;

use Livewire\Component;

class SimpleMessage extends Component
{
    public $output = '';
 
    public function submit($input)
    {
        $this->output = ai($input, function($chunk){
            $this->stream('output', $chunk, true);
        });
    }

    public function render()
    {
        return view('livewire.simple-message');
    }
}
