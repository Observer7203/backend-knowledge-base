<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudySession extends Model
{
    protected $fillable = ['module_id', 'duration_minutes', 'notes', 'studied_at'];
    protected $casts = ['studied_at' => 'date'];
}
