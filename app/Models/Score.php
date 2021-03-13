<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'value', 'semester', 'student_id', 'lesson_id', 'score_category_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function scoreCategory()
    {
        return $this->belongsTo(ScoreCategory::class);
    }
}
