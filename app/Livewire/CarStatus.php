<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CarStatus extends Component
{
    public $carStatus;

    public function render()
    {
        return view('livewire.car-status');
    }
}
