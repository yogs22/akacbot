<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'classes';

    protected $fillable = ['name', 'sub'];
}
