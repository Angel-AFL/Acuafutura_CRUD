<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [ 
        'id',
        'nombre',
        'apellido',
        'edad',
        'correo',
        'id_users',
    ];
}
