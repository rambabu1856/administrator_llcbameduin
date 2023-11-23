<?php

namespace App\Http\Controllers\Admin\StudentManagement;

use App\Models\Select\Batch;
use Illuminate\Http\Request;
use App\Models\Select\Campus;
use App\Models\Select\Course;
use App\Models\Select\Gender;
use App\Models\Select\IsActive;
use App\Models\Select\Religion;
use App\Models\Select\Community;
use App\Models\Select\Department;
use App\Models\Select\AcademicYear;
use App\Http\Controllers\Controller;
use App\Models\StudentManagement\Student;
use App\Models\StudentManagement\AdmissionRegister;

class AdmissionRegisterController extends Controller
{
  public $campus, $department, $course, $batch, $academicYear, $gender, $community, $religion, $yesNo;

  public function __construct()
  {
    $this->campus       = Campus::get();
    $this->department   = Department::get();
    $this->course       = Course::get();
    $this->batch        = Batch::orderBy('title', 'DESC')->get();
    $this->academicYear = AcademicYear::orderBy('batch_id', 'DESC')->orderBy('grade_id', 'ASC')->get();
    $this->gender       = Gender::get();
    $this->community    = Community::get();
    $this->religion     = Religion::get();
    $this->yesNo        = IsActive::select('id', 'title')->get();
  }

  public function index(Request $request)
  {

    // Filter
    $campus           = $this->campus;

    if ($request->cmbCampus) {
      $department   = $this->department->where('campus_id', $request->cmbCampus)->get();
    } else {
      $department   = $this->department;
    }

    if ($request->cmbDepartment) {
      $course       = $this->department->where('department_id', $request->cmbDepartment)->get();
    } else {
      $course       = $this->course;
    }

    if ($request->cmbCourse) {
      $batch        = $this->batch->whereIn('course_id', $request->cmbCourse);
    } else {
      $batch        = $this->batch;
    }

    if ($batch != []) {
      $academicYear = $this->academicYear->whereIn('batch_id', $request->cmbBatch);
    } else {
      $academicYear = [];
    }

    $gender           = $this->gender;
    $community        = $this->community;
    $religion         = $this->religion;
    $yesNo            = $this->yesNo;

    return view(
      'dashboard.admin.studentmanagement.admissionregister.index',
      compact(
        'campus',
        'department',
        'course',
        'batch',
        'academicYear',
        'gender',
        'community',
        'religion',
        'yesNo',
      )
    );
  }

  public function create(Request $request)
  {

    
    if ($request->cmbBatch && $request->cmbCourse) {
      $studentProfileData       = Student::with('campus')
        ->with('department')
        ->with('course')
        ->with('batch')
        ->with('gender')
        ->with('community')
        ->with('religion')
        ->with('bloodGroup')
        ->with('motherTongue')
        ->with('nationality')
        ->with(array('admissionRegisters' => function ($query) use ($request) {
          $query
            ->with('academicYear.year')
            ->with('grade')
            ->where('academic_year_id', $request->cmbAcademicYear)
            ->orderBy('grade_id', 'ASC');
        }));

      if ($request->cmbBatch) {
        $studentProfileData   = $studentProfileData->where('batch_id', $request->cmbBatch);
      }

      if ($request->cmbGender) {
        $studentProfileData   = $studentProfileData->where('gender_id', $request->cmbGender);
      }

      if ($request->cmbCommunity) {
        $studentProfileData   = $studentProfileData->where('community_id', $request->cmbCommunity);
      }

      $studentProfileData       = $studentProfileData->orderBy('enrollment_number')->get();
    } else {
      $studentProfileData       = [];
    }

    return $studentProfileData;
  }


  public function store(Request $request)
  {
    //
  }


  public function show(AdmissionRegister $admissionRegister)
  {
  }


  public function edit(Request $request, AdmissionRegister $admissionRegister)
  {

    $studentProfileData   = Student::with('campus')
      ->with('department')
      ->with('course')
      ->with('batch')
      ->with('gender')
      ->with('community')

      ->with(array('admissionRegisters' => function ($query) use ($request) {
        $query
          ->with('academicYear.year')
          ->with('grade')
          ->where('academic_year_id', $request->cmbAcademicYear)
          ->orderBy('grade_id', 'ASC');
      }))
      ->orderBy('enrollment_number')->get();

    return $studentProfileData;
  }


  public function update(Request $request, AdmissionRegister $admissionRegister)
  {
    //
  }


  public function destroy(AdmissionRegister $admissionRegister)
  {
    //
  }
}
