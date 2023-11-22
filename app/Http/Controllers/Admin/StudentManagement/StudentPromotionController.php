<?php

namespace App\Http\Controllers\Admin\StudentManagement;


use App\Models\Select\Batch;
use Illuminate\Http\Request;
use App\Models\Select\Campus;
use App\Models\Select\Course;
use App\Models\Select\Department;
use App\Models\Select\AcademicYear;
use App\Http\Controllers\Controller;
use App\Models\StudentManagement\Student;


class StudentPromotionController extends Controller
{
    public $campus, $department, $course, $batch, $academicYear, $grade;

    public function __construct()
    {
        $this->campus = Campus::get();
        $this->department = Department::get();
        $this->course = Course::get();
        $this->batch = Batch::orderBy('title', 'DESC')->get();
        $this->academicYear = AcademicYear::orderBy('batch_id', 'DESC')->orderBy('grade_id', 'ASC')->get();
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
            $batch = $this->batch->where('course_id', $request->cmbCourse);
        } else {
            $batch = $this->batch;
        }

        if ($batch != []) {
            $academicYear = $this->academicYear->where('batch_id', $request->cmbBatch);
        } else {
            $academicYear = [];
        }

        if ($batch != []) {
            $academicYear = $this->academicYear->where('batch_id', $request->cmbBatch);
        } else {
            $academicYear = [];
        }

        return view(
            'administrator.studentmanagement.studentpromotion.index',
            compact(
                'campus',
                'department',
                'course',
                'batch',
                'academicYear',
            )
        );
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
            ->where('batch_id', $request->cmbBatch)
            ->with(array('admissionRegisters' => function ($query) use ($request) {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
