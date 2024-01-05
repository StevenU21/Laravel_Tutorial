<?php

namespace App\Livewire\Rents;

use App\Models\Rent;
use Livewire\Component;

class ShowRents extends Component
{
    public $rent;

    public function mount(Rent $rent)
    {
        $this->rent = $rent;
    }

    public function render()
    {
        return view('livewire.rents.show-rents');
    }
}
