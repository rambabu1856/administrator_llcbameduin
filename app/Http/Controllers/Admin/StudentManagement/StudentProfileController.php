<?php

namespace App\Http\Controllers\Admin\StudentManagement;


use Carbon\Carbon;
use App\Models\Select\Batch;
use Illuminate\Http\Request;
use App\Models\Select\Campus;
use App\Models\Select\Course;
use App\Models\Select\Gender;
use App\Models\Select\IsActive;
use App\Models\Select\Religion;
use App\Models\Select\Community;
use App\Models\Select\BloodGroup;
use App\Models\Select\Department;
use App\Models\Select\Nationality;
use App\Models\Select\AcademicYear;
use App\Models\Select\MotherTongue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentManagement\Student;

class StudentProfileController extends Controller
{
  public $campus, $campus_id, $department, $course, $batch, $academicYear, $gender, $community, $religion, $bloodGroup, $motherTongue, $nationality, $is_active;

  public function __construct($campus_id)
  {
    $this->campus       = Campus::get();
    $this->department   = Department::get();
    $this->course       = Course::get();
    $this->batch        = Batch::orderBy('title', 'DESC')->get();
    $this->academicYear = AcademicYear::orderBy('batch_id', 'DESC')->orderBy('grade_id', 'ASC')->get();
    $this->gender       = Gender::get();
    $this->community    = Community::get();
    $this->bloodGroup   = BloodGroup::get();
    $this->religion     = Religion::get();
    $this->motherTongue = MotherTongue::get();
    $this->nationality  = Nationality::get();
    $this->is_active    = IsActive::select('id', 'title')->get();
  }

  public function index(Request $request)
  {
    // Filter
    $campus_id         = Auth::guard('admin')->user()->campus_id;

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

    $gender         = $this->gender;
    $community      = $this->community;
    $religion       = $this->religion;
    $bloodGroup     = $this->bloodGroup;
    $motherTongue   = $this->motherTongue;
    $nationality    = $this->nationality;
    $is_active          = $this->is_active;

    return view(
      'dashboard.admin.studentmanagement.studentprofile.index',
      compact(
        'campus',
        'department',
        'course',
        'batch',
        'academicYear',
        'gender',
        'community',
        'religion',
        'bloodGroup',
        'motherTongue',
        'nationality',
        'is_active',
      )
    );
  }

  public function create(Request $request)
  {

    dd($campus_id);
    // FILTERED DATA TO TABLE
    $studentProfileData = Student::with('campus')
      ->with('department')
      ->with('course')
      ->with('batch')
      ->with('gender')
      ->with('community')
      ->with('religion')
      ->with('bloodGroup')
      ->with('motherTongue')
      ->with('nationality')
      ->with(
        array(
          'admissionRegisters' => function ($query) {
            $query
              ->with('academicYear.year')
              ->with('grade')
              ->orderBy('grade_id', 'ASC');
          }
        )
      );

    if ($request->cmbBatch) {
      $studentProfileData   = $studentProfileData->where('batch_id', $request->cmbBatch);
    }

    if ($request->cmbGender) {
      $studentProfileData   = $studentProfileData->where('gender_id', $request->cmbGender);
    }

    if ($request->cmbCommunity) {
      $studentProfileData   = $studentProfileData->where('community_id', $request->cmbCommunity);
    }

    if ($request->cmbIsPwd) {
      $studentProfileData   = $studentProfileData->where('is_pwd', $request->cmbIsPwd);
    }

    if ($request->txtSearchBy) {
      $studentProfileData = $studentProfileData->where(function (
        $q
      ) use ($request) {
        $q
          ->where('student_name', 'like', '%' . $request->txtSearchBy . '%')
          ->orWhere('enrollment_number', 'like', '%' . $request->txtSearchBy . '%');
      });
    }

    $studentProfileData     = $studentProfileData->where('campus_id',)->orderBy('enrollment_number')->get();

    return $studentProfileData;
  }

  public function store(Request $request)
  {

    // dd($request->all());

    $model = Student::updateOrCreate(
      [
        'id' => $request->txtModalStudentId,

      ],
      [
        'campus_id' => $request->cmbModalCampus,
        'department_id' => $request->cmbModalDepartment,
        'course_id' => $request->cmbModalCourse,
        'batch_id' => $request->cmbModalBatch,
        'syllabus_year_id' => ($request->syllabus_year_id ? $request->syllabus_year_id : null),
        'enrollment_number' => $request->txtModalRollNo . "/" . $request->txtModalEnrollmentYear,
        'registration_number' => $request->txtModalRegistrationNumber,
        'registration_year' => $request->txtModalRegistrationYear,
        'examination_roll_number' => $request->txtModalExaminationRollNumber,
        'examination_roll_number_year' => $request->txtModalExaminationRollYear,

        'student_name' => $request->txtModalStudentName,
        'father_name' => $request->txtModalFatherName,
        'mother_name' => $request->txtModalMotherName,
        'guardian_name' => $request->txtModalGuardianName,
        'date_of_birth' => Carbon::createFromFormat('d/m/Y', $request->txtModalDateOfBirth)->format('Y-m-d'),
        'gender_id' => $request->cmbModalGender,
        'community_id' => $request->cmbModalCommunity,
        'religion_id' => $request->cmbModalReligion,
        'blood_group_id' => $request->cmbModalBloodGroup,
        'mother_tongue_id' => $request->cmbModalMotherTongue,
        'nationality_id' => $request->cmbModalNationality,

        'email_id' => $request->txtModalEmail,
        'phone_no' => $request->txtModalPhoneNumber,
        'phone_no_other' => $request->txtModalPhoneNumberOther,

        'local_address_l1' => $request->txtModalLocalAddressL1,
        'local_address_l2' => $request->txtModalLocalAddressL2,
        'local_po_name' => $request->txtModalLocalPostOffice,
        'local_district' => $request->txtModalLocalDistrict,
        'local_state' => $request->txtModalLocalState,
        'local_pin' => $request->txtModalLocalPin,

        'permanent_address_l1' => $request->txtModalPermanentAddressL1,
        'permanent_address_l2' => $request->txtModalPermanentAddressL2,
        'permanent_po_name' => $request->txtModalPermanentPostOffice,
        'permanent_district' => $request->txtModalPermanentDistrict,
        'permanent_state' => $request->txtModalPermanentState,
        'permanent_pin' => $request->txtModalPermanentPin,

        'is_pwd' => $request->cmbModalIsPwd,
      ]
    );
    return $model;
  }

  public function show($id)
  {
  }

  public function edit(Request $request, $id)
  {

    $studentProfileData = Student::with(
      array(
        'admissionRegisters' => function ($query) {
          $query
            ->with('academicYear.year')
            ->with('grade')
            ->orderBy('grade_id', 'ASC');
        }
      )
    )
      ->findOrFail($id);

    return $studentProfileData;
  }


  public function update(Request $request, $id)
  {
  }

  public function destroy($id)
  {
  }
}
