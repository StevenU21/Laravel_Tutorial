<?php

namespace App\Livewire\Rents;

use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class StoreRents extends Component
{
    public $users;
    public $books;
    public $user_id;
    public $book_id;
    public $rent_days;

    // Para mostrar los detalles del libro seleccionado
    public $selectedBookDetails = null;
    public $showBookDetails = false;

    public function mount()
    {
        $this->users = User::all();
        $this->books = Book::where('status', 'available')->get();
    }

    public function updatedBookId()
    {
        // Obtén y almacena los detalles del libro cuando se actualiza book_id
        $this->updateBookDetails();
    }

    public function updateBookDetails()
    {
        $book = Book::find($this->book_id);
        $this->selectedBookDetails = $book;
        $this->showBookDetails = true;
    }

    public function store()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'rent_days' => 'required|integer|min:1',
        ]);

        $user = User::findOrFail($this->user_id);
        $book = Book::findOrFail($this->book_id);

        $rentDate = Carbon::now();
        $returnDate = (clone $rentDate)->addDays($this->rent_days);

        if ($book->stock > 0) {
            $rent = new Rent([
                'rent_date' => $rentDate,
                'return_date' => $returnDate,
            ]);

            $rent->user()->associate($user);
            $rent->book()->associate($book);

            $rent->save();

            $book->stock -= 1;
            if ($book->stock == 0) {
                $book->status = 'unavailable';
            }
            $book->save();

            //resetear inputs
            $this->reset(['user_id', 'book_id', 'rent_days']);

            $this->dispatch('success');
        } else {
            $this->dispatch('error', 'No hay existencias de este libro');
        }
    }

    public function render()
    {
        return view('livewire.rents.store-rents');
    }
}
