<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    use HasFactory;

    protected $table='vacaciones';

    protected $fillable = [
        'id_employee',
        'motivo',
        'fecha_inicio',
        'fecha_final'
    ];
}
