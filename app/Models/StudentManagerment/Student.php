<?php

namespace App\Models\StudentManagement;

use App\Models\Select\Batch;
use App\Models\Select\Course;
use App\Models\Select\Gender;
use App\Models\Select\Religion;
use App\Models\Select\YnOption;
use App\Models\Select\Community;
use App\Models\Select\BloodGroup;
use App\Models\Select\Nationality;
use App\Models\Select\MotherTongue;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentManagement\AdmissionRegister;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{

    use HasFactory;

    protected $guarded = []; // this is important

    public function campus()
    {
        return $this->hasOne(Course::class, 'id', 'campus_id');
    }

    public function department()
    {
        return $this->hasOne(Course::class, 'id', 'department_d');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function batch()
    {
        return $this->hasMany(Batch::class, 'id', 'batch_id');
    }

    public function gender()
    {
        return $this->hasOne(Gender::class, 'id', 'gender_id');
    }

    public function community()
    {
        return $this->hasOne(Community::class, 'id', 'community_id');
    }

    public function religion()
    {
        return $this->hasOne(Religion::class, 'id', 'religion_id');
    }

    public function bloodGroup()
    {
        return $this->hasOne(BloodGroup::class, 'id', 'blood_group_id');
    }

    public function motherTongue()
    {
        return $this->hasOne(MotherTongue::class, 'id', 'mother_tongue_id');
    }

    public function nationality()
    {
        return $this->hasOne(Nationality::class, 'id', 'nationality_id');
    }

    public function yesNoOptions()
    {
        return $this->hasOne(AdmissionRegister::class, 'student_id', 'id');
    }

    public function admissionRegisters()
    {
        return $this->hasMany(AdmissionRegister::class);
    }



    // public function ReservationCategory()
    // {
    //   return $this->hasOne(ReservationCategories::class, 'id', 'reservation_category_id');
    // }

    // public function getReservationGroup()
    // {
    //     return $this->hasOne(ReservationCategories::class, 'reservation_group_id', 'reservation_group_id');
    // }

    // public function getContact()
    // {
    //   return $this->hasOne(AdmissionContact::class, 'profile_id', 'id');
    // }

    // public function getProcessingFee()
    // {
    //   return $this->hasOne(AdmissionProcessingFee::class, 'profile_id', 'id');
    // }

    // public function getMigration()
    // {
    //   return $this->hasOne(AdmissionMigration::class, 'profile_id', 'id');
    // }

    // public function getQualifications()
    // {
    //   return $this->hasMany(AdmissionQualification::class, 'profile_id', 'id');
    // }

    // public function getAdmissionFee()
    // {
    //   return $this->hasOne(AdmissionFee::class, 'profile_id', 'id');
    // }

    // public function getFormStatus()
    // {
    //   return $this->hasOne(AdmissionFormStatus::class, 'profile_id', 'id');
    // }
}
