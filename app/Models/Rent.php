<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_date',
        'return_date',
        'book_id',
        'user_id',
    ];

    // Relación con la tabla users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la tabla books
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
