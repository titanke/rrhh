<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{
    use HasFactory;

    protected $table = "justificaciones";

    protected $fillable = [
        'id_employee',
        'justificacion',
        'fecha',
        'fecha_final',
        'hora_inicio',
        'hora_final'
    ];
}
