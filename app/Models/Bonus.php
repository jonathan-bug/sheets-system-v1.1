<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonus';
    protected $fillable = [
        'employee_dui',
        'period_id',
        'amount'
    ];
}
