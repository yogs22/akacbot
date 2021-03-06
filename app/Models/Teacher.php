<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nuptk', 'name', 'address', 'phone_number', 'gender'
    ];

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }
}
