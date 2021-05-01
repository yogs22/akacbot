<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonTeacher extends Model
{
    protected $table = 'lesson_teacher';

    protected $fillable = [
        'teacher_id', 'lesson_id', 'class_id', 'major_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function getFullGradeAttribute()
    {
        return "{$this->grade->name} {$this->major->code} {$this->grade->sub}";
    }
}
