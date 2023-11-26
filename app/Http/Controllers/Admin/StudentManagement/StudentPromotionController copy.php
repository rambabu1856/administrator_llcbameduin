<?php

namespace App\Http\Controllers\Admin\StudentManagement;


use App\Models\Select\Batch;
use Illuminate\Http\Request;
use App\Models\Select\Campus;
use App\Models\Select\Course;
use App\Models\Select\Department;
use App\Models\Select\AcademicYear;
use App\Http\Controllers\Controller;
use App\Models\FeeManagement\FeeGroupHead;
use App\Models\Select\ModeOfTransaction;
use App\Models\StudentManagement\Student;


class StudentPromotionController extends Controller
{
    public $campus, $department, $course, $batch, $academicYear, $grade, $modeOfTransaction;

    public function __construct()
    {
        $this->campus = Campus::get();
        $this->department = Department::get();
        $this->course = Course::get();
        $this->batch = Batch::orderBy('title', 'DESC')->get();
        $this->academicYear = AcademicYear::orderBy('batch_id', 'DESC')->orderBy('grade_id', 'ASC')->get();
        $this->modeOfTransaction = ModeOfTransaction::where('id', '>', 1)->get();
    }

    public function index(Request $request)
    {
        dd('here');
        // $campus = $this->campus;

        // if ($request->cmbCampus) {
        //     $department = $this->department->where('campus_id', $request->cmbCampus)->get();
        // } else {
        //     $department = $this->department;
        // }

        // if ($request->cmbDepartment) {
        //     $course = $this->department->where('department_id', $request->cmbDepartment)->get();
        // } else {
        //     $course = $this->course;
        // }

        // if ($request->cmbCourse) {
        //     $batch = $this->batch->where('course_id', $request->cmbCourse);
        // } else {
        //     $batch = $this->batch;
        // }

        // if ($batch != []) {
        //     $academicYear = $this->academicYear->where('batch_id', $request->cmbBatch);
        // } else {
        //     $academicYear = [];
        // }

        // if ($batch != []) {
        //     $academicYear = $this->academicYear->where('batch_id', $request->cmbBatch);
        // } else {
        //     $academicYear = [];
        // }

        // $modeOfTransaction = $this->modeOfTransaction;

        // return view(
        //     'dashboard.admin.studentmanagement.studentpromotion.index',
        //     compact(
        //         'campus',
        //         'department',
        //         'course',
        //         'batch',
        //         'academicYear',
        //         'modeOfTransaction',
        //     )
        // );
    }

    public function create(Request $request)
    {

        $studentsNotPromoted = Student::with('campus')
            ->with('department')
            ->with('course')
            ->with('batch')
            ->with('gender')
            ->with('community')
            ->with('religion')
            ->with('bloodGroup')
            ->with('motherTongue')
            ->with('nationality')
            ->where('batch_id', $request->cmbBatch);

        if ($request->txtSearchBy) {
            $studentsNotPromoted = $studentsNotPromoted->where(function (
                $q
            ) use ($request) {
                $q
                    ->where('student_name', 'like', '%' . $request->txtSearchBy . '%')
                    ->orWhere('enrollment_number', 'like', '%' . $request->txtSearchBy . '%');
            });
        }

        $studentsNotPromoted = $studentsNotPromoted->with(array('admissionRegisters' => function ($query) use ($request) {
            $query
                ->with('academicYear.year')
                ->with('grade')
                ->where('academic_year_id', $request->cmbAcademicYear)
                ->orderBy('grade_id', 'ASC');
        }))
            ->whereHas('admissionRegisters', function ($query) use ($request) {
                $query->where('grade_id', $request->cmbGrade) // Filter by Level 1
                    ->whereNotIn('student_id', function ($subQuery) use ($request) {
                        $subQuery->select('student_id')
                            ->from('admission_registers')
                            ->where('grade_id', (int)$request->cmbGrade + 1);
                    });
            })->get();


        return $studentsNotPromoted;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
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
        )->findOrFail($id);

        return response()->json(['code' => 2, 'data' => $studentProfileData]);
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
