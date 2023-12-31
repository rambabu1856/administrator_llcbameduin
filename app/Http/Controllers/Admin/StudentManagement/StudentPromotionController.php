<?php

namespace App\Http\Controllers\Admin\StudentManagement;


use Carbon\Carbon;
use App\Models\Select\Batch;
use Illuminate\Http\Request;
use App\Models\Select\Campus;
use App\Models\Select\Course;
use App\Models\Select\Department;
use App\Models\Select\AcademicYear;
use App\Http\Controllers\Controller;
use App\Models\Accounts\Transaction;
use App\Models\Select\ModeOfTransaction;
use App\Models\StudentManagement\Student;
use App\Models\StudentManagement\AdmissionRegister;


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

        $modeOfTransaction = $this->modeOfTransaction;

        return view(
            'dashboard.admin.studentmanagement.studentpromotion.index',
            compact(
                'campus',
                'department',
                'course',
                'batch',
                'academicYear',
                'modeOfTransaction',
            )
        );
    }

    public function create(Request $request)
    {

        $academicYear = AcademicYear::where('course_id', $request->cmbCourse)
            ->where('batch_id', $request->cmbBatch)
            ->where('grade_id', $request->cmbFromGrade)->first();
        // dd($academicYear);

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
            ->where('batch_id', $academicYear->batch_id);

        if ($request->txtSearchBy) {
            $studentsNotPromoted = $studentsNotPromoted->where(function (
                $q
            ) use ($request) {
                $q
                    ->where('student_name', 'like', '%' . $request->txtSearchBy . '%')
                    ->orWhere('enrollment_number', 'like', '%' . $request->txtSearchBy . '%');
            });
        }

        $studentsNotPromoted = $studentsNotPromoted->with(array('admissionRegisters' => function ($query) use ($academicYear) {
            $query
                ->with('academicYear.year')
                ->with('grade')
                ->where('academic_year_id', $academicYear->id)
                ->orderBy('grade_id', 'ASC');
        }))
            ->whereHas('admissionRegisters', function ($query) use ($academicYear) {
                $query->where('grade_id', $academicYear->grade_id) // Filter by Level 1
                    ->whereNotIn('student_id', function ($subQuery) use ($academicYear) {
                        $subQuery->select('student_id')
                            ->from('admission_registers')
                            ->where('grade_id', (int)$academicYear->grade_id + 1);
                    });
            })->get();


        return $studentsNotPromoted;
    }

    public function store(Request $request)

    {
        $academicYear = AcademicYear::with('year')->where('course_id', $request->cmbCourseId)
            ->where('batch_id', $request->cmbBatchId)
            ->where('grade_id', $request->txtToGradeId)->first();


        $model = AdmissionRegister::updateOrCreate(
            [
                'student_id' => $request->txtstudentId,
                'course_id' => $request->cmbCourseId,
                'academic_year_id' => $academicYear->id,
                'grade_id' => $request->txtToGradeId,
            ],
            [
                'roll_no' => (int)$request->txtRollNo,
                'slug' => $academicYear->slug,
                'enrollment_no' => $request->txtEnrollmentNumber,
                'admission_date' => Carbon::createFromFormat('d/m/Y', $request->txtReceiptDate)->format('Y-m-d'),
            ]
        );

        if ($model->id) {
            $modelTransaction = Transaction::updateOrCreate(
                [
                    'transaction_reference_no' => $request->feeReference,
                ],
                [
                    'student_id' => $request->txtstudentId,
                    'enrollment_number' => $request->txtEnrollmentNumber,
                    'grade_id' => $request->txtToGradeId,
                    'academic_year_id' => $academicYear->id,
                    'academic_year' => $academicYear->year->title,
                    'fee_group_head_id' => 1,
                    'is_sbc_used' => 1,
                    'office_remark' => $request->txtareaRemark,
                ]
            );
        }
        return $modelTransaction;
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
