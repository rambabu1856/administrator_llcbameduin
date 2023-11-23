<?php

namespace App\Models\StudentManagement;

use App\Models\Select\Year;
use App\Models\Select\Grade;
use App\Models\Select\AcademicYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmissionRegister extends Model
{
    use HasFactory;


    public function grade()
    {
        return $this->hasOne(Grade::class, 'id', 'grade_id');
    }


    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }


    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
