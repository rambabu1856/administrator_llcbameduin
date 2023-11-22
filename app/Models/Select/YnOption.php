<?php

namespace App\Models\Select;

use App\Models\StudentManagement\AdmissionRegister;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YnOption extends Model
{
    use HasFactory;


    public function academicYear()
    {
        return $this->hasMany(AcademicYear::class);
    }

      public function admissionRegister()
    {
        return $this->hasManyThrough(AdmissionRegister::class, AcademicYear::class);
    }

}
