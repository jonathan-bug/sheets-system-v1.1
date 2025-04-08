<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $table = 'hours';
    protected $fillable = [
        'employee_dui',
        'hour',
        'type'
    ];
}
