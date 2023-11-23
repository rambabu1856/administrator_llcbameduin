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
use App\Models\Select\BloodGroup;
use App\Models\Select\Department;
use App\Models\Select\Nationality;
use App\Models\Select\AcademicYear;
use App\Models\Select\MotherTongue;
use App\Http\Controllers\Controller;
use App\Models\StudentManagement\Student;

class StudentProfileController extends Controller
{
    public $campus, $department, $course, $batch, $academicYear, $gender, $community, $religion, $bloodGroup, $motherTongue, $nationality, $yesNo;

    public function __construct()
    {
        $this->campus = Campus::get();
        $this->department = Department::get();
        $this->course = Course::get();
        $this->batch = Batch::orderBy('title', 'DESC')->get();
        $this->academicYear = AcademicYear::orderBy('batch_id', 'DESC')->orderBy('grade_id', 'ASC')->get();
        $this->gender = Gender::get();
        $this->community = Community::get();
        $this->bloodGroup = BloodGroup::get();
        $this->religion = Religion::get();
        $this->motherTongue = MotherTongue::get();
        $this->nationality = Nationality::get();
        $this->yesNo = IsActive::select('id', 'title')->get();
    }

    public function index(Request $request)

    {
        // Filter
        $campus = $this->campus;

        if ($request->cmbCampus) {
            $department = $this->department->where('campus_id', $request->cmbCampus)->get();
        } else {
            $department = $this->department;
        }

        if ($request->cmbDepartment) {
            $course = $this->department->where('department_id', $request->cmbDepartment)->get();
        } else {
            $course = $this->course;
        }

        if ($request->cmbCourse) {
            $batch = $this->batch->whereIn('course_id', $request->cmbCourse);
        } else {
            $batch = $this->batch;
        }

        if ($batch != []) {
            $academicYear = $this->academicYear->whereIn('batch_id', $request->cmbBatch);
        } else {
            $academicYear = [];
        }

        $gender = $this->gender;
        $community = $this->community;
        $religion = $this->religion;
        $bloodGroup = $this->bloodGroup;
        $motherTongue = $this->motherTongue;
        $nationality = $this->nationality;
        $yesNo = $this->yesNo;

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
                'yesNo',
            )
        );
    }

    public function create(Request $request)
    {

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
            ->with(array('admissionRegisters' => function ($query) {
                $query
                    ->with('academicYear.year')
                    ->with('grade')
                    ->orderBy('grade_id', 'ASC');
            }));

        if ($request->cmbBatch) {
            $studentProfileData =  $studentProfileData->where('batch_id', $request->cmbBatch);
        }

        if ($request->cmbGender) {
            $studentProfileData =  $studentProfileData->where('gender_id', $request->cmbGender);
        }

        if ($request->cmbCommunity) {
            $studentProfileData =  $studentProfileData->where('community_id', $request->cmbCommunity);
        }

        $studentProfileData =  $studentProfileData->orderBy('enrollment_number')->take(5)->get();

        return $studentProfileData;
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit(Request $request, $id)
    {

        $studentProfileData = Student::with(array('admissionRegisters' => function ($query) {
            $query
                ->with('academicYear.year')
                ->with('grade')
                ->orderBy('grade_id', 'ASC');
        }))
            ->findOrFail($id);



        // dd($studentProfileData->admissionRegister);
        return $studentProfileData;
    }


    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
