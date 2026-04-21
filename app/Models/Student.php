<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $fillable = [
        'registration_no',
        'full_name',
        'father_name',
        'date_of_birth',
        'cnic',
        'contact',
        'address',
        'admission_date',
        'class_level',
        'status',
    ];

    /**
     * Auto-generate registration number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {

            $year = date('Y');

            // Count existing students for current year
            $count = DB::table('students')
                ->whereYear('created_at', $year)
                ->count();

            $nextNumber = str_pad($count + 1, 6, '0', STR_PAD_LEFT);

            $student->registration_no = "ABAU-$year-REG-$nextNumber";
        });
    }

    /**
     * Relationship: Student Documents
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

}