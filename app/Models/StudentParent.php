<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    use HasFactory;

    protected $table = 'parents';
    protected $fillable = [
        'name', 'address', 'phone_number', 'religion', 'relation', 'student_id'
    ];

    public function student()
    {
        $this->belongsTo(Student::class);
    }
}
