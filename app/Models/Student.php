<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_name',
        'email',
        'phone'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

}
