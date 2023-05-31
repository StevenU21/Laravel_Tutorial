<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Asistencia
 *
 * @property $id
 * @property $fecha
 * @property $hora_entrada
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Asistencia extends Model
{
    
    static $rules = [
		'fecha' => 'required',
		'hora_entrada' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','hora_entrada'];



}
