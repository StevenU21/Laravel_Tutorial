<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentsController extends Controller
{
    public function index()
    {
        $rents = Rent::with('user', 'book')->get();
        return view('rents.index', compact('rents'));
    }

    public function create()
    {
        $users = User::all();
        $books = Book::where('status', 'available')->get();

        return view('rents.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        // Validaciones (puedes agregar más según tus necesidades)
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'rent_days' => 'required|integer|min:1',
        ]);

        // Obtener usuario y libro
        $user = User::findOrFail($request->user_id);
        $book = Book::findOrFail($request->book_id);

        // Calcular fechas de renta y retorno
        $rentDate = now();
        $returnDate = (clone $rentDate)->addDays($request->rent_days);

        // Verificar stock disponible
        if ($book->stock > 0) {
            // Crear la renta
            $rent = new Rent([
                'rent_date' => $rentDate,
                'return_date' => $returnDate,
            ]);

            $rent->user()->associate($user);
            $rent->book()->associate($book);

            $rent->save();

            // Actualizar stock y estado del libro
            $book->stock -= 1;
            if ($book->stock == 0) {
                $book->status = 'unavailable';
            }
            $book->save();

            return redirect()->route('rents.index')->with('success', 'Renta registrada exitosamente.');
        } else {
            return redirect()->route('rents.create')->with('error', 'El libro no está disponible para renta.');
        }
    }

    public function edit($id)
    {
        $rent = Rent::findOrFail($id);
        $users = User::all();
        $books = Book::where('status', 'available')->get();
        $rentDays = Carbon::parse($rent->rent_date)->diffInDays(Carbon::parse($rent->return_date));


        return view('rents.edit', compact('rent', 'users', 'books', 'rentDays'));
    }

    public function update(Request $request, $id)
    {
        // Validaciones (puedes agregar más según tus necesidades)
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'rent_days' => 'required|integer|min:1',
        ]);

        // Encuentra la renta por su id
        $rent = Rent::findOrFail($id);

        // Encuentra el libro anteriormente asociado a la renta
        $oldBook = Book::findOrFail($rent->book_id);

        // Si el libro ha cambiado, actualiza el stock y el estado del libro anterior
        if ($oldBook->id != $request->book_id) {
            $oldBook->stock += 1;
            if ($oldBook->stock > 0) {
                $oldBook->status = 'available';
            }
            $oldBook->save();
        }

        // Encuentra el nuevo libro asociado a la renta
        $newBook = Book::findOrFail($request->book_id);

        // Verifica si el nuevo libro está disponible
        if ($newBook->stock > 0) {
            // Actualiza la renta
            $rent->update([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'rent_date' => now(),
                'return_date' => now()->addDays($request->rent_days),
            ]);

            // Actualiza el stock y el estado del nuevo libro
            $newBook->stock -= 1;
            if ($newBook->stock == 0) {
                $newBook->status = 'unavailable';
            }
            $newBook->save();

            return redirect()->route('rents.index')->with('success', 'Renta actualizada exitosamente.');
        } else {
            return redirect()->route('rents.edit', $id)->with('error', 'El libro no está disponible para renta.');
        }
    }

    public function destroy($id)
    {
        // Encuentra la renta por su id
        $rent = Rent::findOrFail($id);

        // Encuentra el libro asociado a la renta
        $book = Book::findOrFail($rent->book_id);

        // Actualiza el stock y el estado del libro
        $book->stock += 1;
        if ($book->stock > 0) {
            $book->status = 'available';
        }
        $book->save();

        // Elimina la renta
        $rent->delete();

        return redirect()->route('rents.index')->with('success', 'Renta eliminada exitosamente.');
    }

    public function show($id)
    {
        $rent = Rent::findOrFail($id);
        return view('rents.show', compact('rent'));
    }
}
