<?php

namespace App\Models\Select;

use App\Models\Select\Grade;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentManagement\AdmissionRegister;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    public function admissionRegister()
    {
        return $this->hasOne(AdmissionRegister::class, 'academic_year_id');
    }

    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
