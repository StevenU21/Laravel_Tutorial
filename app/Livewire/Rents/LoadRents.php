<?php

namespace App\Livewire\Rents;

use App\Models\Rent;
use Livewire\Component;
use Livewire\WithPagination;

class LoadRents extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function deleteRent($rentId)
    {
        Rent::find($rentId)->delete();
        $this->dispatch('danger');
    }

    public function render()
    {
        $rents = Rent::with('user', 'book')->paginate(10);
        return view('livewire.rents.load-rents', compact('rents'));
    }
}
