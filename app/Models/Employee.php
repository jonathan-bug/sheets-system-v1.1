<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Salary;
use App\Models\Hour;
use App\Models\Bonus;

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

    public function salaries() {
        return $this->hasMany(Salary::class);
    }

    public function hours() {
        return $this->hasMany(Hour::class);
    }

    public function bonus() {
        return $this->hasMany(Bonus::class);
    }
}
