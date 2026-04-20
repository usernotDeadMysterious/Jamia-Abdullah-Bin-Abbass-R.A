<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    protected $fillable = [
        'student_id',
        'type',
        'file_path',
    ];

    /**
     * Relationship: belongs to Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}