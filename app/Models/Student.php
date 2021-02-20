<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nisn', 'name', 'gender', 'address', 'birthplace', 'birthdate', 'phone_number', 'religion', 'parent_id', 'major_id'
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function parent()
    {
        return $this->belongsTo(StudentParent::class);
    }
}
