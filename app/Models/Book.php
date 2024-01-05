<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publication_date',
        'stock',
        'status'
    ];

    // Relación con la tabla rents
    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
}
