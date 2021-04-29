<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn', 'name', 'gender', 'address', 'birthplace', 'birthdate', 'phone_number', 'religion', 'major_id', 'class_id'
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }

    public function parents()
    {
        return $this->hasMany(StudentParent::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function getFullBirthAttribute()
    {
        $birthDate = Carbon::parse($this->birthdate)->format('d M Y');

        return "{$this->birthplace} / {$birthDate}";
    }

    public function getDateFormatedAttribute()
    {
        return Carbon::parse($this->birthdate)->format('d M Y');
    }

    public function getFullGradeAttribute()
    {
        return "{$this->grade->name} {$this->major->code} {$this->grade->sub}";
    }
}
