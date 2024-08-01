<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'name',
        'entry_time',
        'exit_time',
        'hasBreak',
        'break_out',
        'break_return'
    ];
}
