<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function getFullBirthAttribute()
    {
        return $this->birthplace .'/'. Carbon::parse($this->birthdate)->format('d M Y');
    }
}
