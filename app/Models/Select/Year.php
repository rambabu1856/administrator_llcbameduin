<?php

namespace App\Models\Select;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    public function academicYears()
    {
        return $this->hasMany(AcademicYear::class, 'year_id'); // 'year_id' is the foreign key in AcademicYear table
    }

    public function admissionRegister()
    {
        return $this->hasOneThrough(
            AdmissionRegister::class,
            AcademicYear::class,
            'year_id', // Foreign key on AcademicYear table
            'academic_year_id', // Foreign key on AdmissionRegister table
            'id', // Local key on Year table
            'id' // Local key on AcademicYear table
        );
    }
}
