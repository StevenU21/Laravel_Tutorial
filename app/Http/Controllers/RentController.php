<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index()
    {
        return view('rents.index');
    }

    public function create()
    {
        return view('rents.create');
    }

    public function edit(string $id)
    {
        $rent = Rent::find($id);
        return view('rents.edit', compact('rent'));
    }

    public function show(string $id)
    {
        $rent = Rent::find($id);
        return view('rents.show', compact('rent'));
    }
}
