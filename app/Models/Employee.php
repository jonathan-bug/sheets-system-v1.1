<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'dui';
    public $incrementing = false;
    protected $fillable = [
        'dui',
        'first_name',
        'second_name',
        'first_lastname',
        'second_lastname',
        'birth_date',
        'hiring_date',
        'calculated_date'
    ];
}
