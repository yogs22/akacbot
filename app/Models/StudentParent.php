<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StudentParent extends Model
{
    use HasFactory;

    protected $table = 'parents';
    protected $fillable = [
        'name', 'address', 'phone_number', 'religion', 'relation', 'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getDateFormatedAttribute()
    {
        return Carbon::parse($this->birthdate)->format('d M Y');
    }
}
