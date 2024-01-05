<?php

namespace App\Livewire\Rents;

use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class UpdateRents extends Component
{
    public $rent;
    public $users;
    public $books;
    public $rent_days;
    public $user_id;
    public $book_id;

    // Para mostrar los detalles del libro seleccionado
    public $selectedBookDetails = null;
    public $showBookDetails = false;

    public function mount(Rent $rent)
    {
        $this->rent = $rent;
        $this->user_id = $this->rent->user_id;
        $this->book_id = $this->rent->book_id;
        $this->rent_days = Carbon::parse($this->rent->rent_date)->diffInDays(Carbon::parse($this->rent->return_date));
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

    public function update()
    {
        $this->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'rent_days' => 'required|integer|min:1',
        ]);

        $user = User::find($this->user_id);
        $newBook = Book::find($this->book_id);

        // Si el usuario o el libro no existen
        if (!$user || !$newBook) {
            session()->flash('error');
            return;
        }

        // Esto es para actualizar el stock del libro anterior
        $oldBook = $this->rent->book;
        $oldBook->stock += 1;
        if ($oldBook->stock > 0) {
            $oldBook->status = 'available';
        }
        $oldBook->save();

        // Esto es para actualizar el stock del libro
        $newBook->stock -= 1;
        if ($newBook->stock == 0) {
            $newBook->status = 'unavailable';
        }
        $newBook->save();

        // Esto es para actualizar el rent
        $this->rent->user_id = $this->user_id;
        $this->rent->book_id = $this->book_id;
        $this->rent->rent_date = Carbon::now();
        $this->rent->return_date = Carbon::now()->addDays($this->rent_days);
        $this->rent->save();

        $this->dispatch('message');
    }

    public function render()
    {
        $this->users = User::all();
        $this->books = Book::where('status', 'available')->get();
        return view('livewire.rents.update-rents');
    }
}
