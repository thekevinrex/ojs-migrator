<?php

namespace App\Livewire;

use Livewire\Component;

class Welcome extends Component
{

    public int $counter = 0;

    public function increment()
    {
        $this->counter++;
    }

    public function render()
    {
        return view('livewire.welcome');
    }
}
