<?php

namespace App\Http\Controllers\Admin\FeeManagement;

use App\Models\Select\Grade;
use Illuminate\Http\Request;
use App\Models\Select\Course;
use App\Http\Controllers\Controller;
use App\Models\StudentManagement\Student;
use App\Models\FeeManagement\FeeGroupHead;
use App\Models\FeeManagement\FeeStructure;
use App\Models\FeeManagement\FeeSubGroupHead;

class FeeStructureController extends Controller
{
    protected $fee_group_head, $course, $grade;

    public function __construct()
    {
        $this->fee_group_head = FeeGroupHead::get();
        $this->course = Course::get();
        $this->grade = Grade::get();
    }


    public function getEligibleFee(Request $request)
    {

        $students = Student::where('id', $request->studentId)->first();

        $feeStructure = FeeStructure::with('feeGroupHead', 'feeSubGroupHead', 'batch', 'grade', 'year')
            ->where('fee_group_head_id', $request->feeGroupHeadId)
            ->where('course_id', $request->courseId)
            ->where('batch_id', $request->batchId)
            ->where('grade_id', $request->gradeId)
            ->get();

        foreach ($feeStructure as $key => $item) {

            // REMOVE TUTION FEE FOR FEMALES
            if ($students->gender_id > 1 && $item->fee_sub_group_head_id == 2) {
                unset($feeStructure[$key]);
            }

            // REMOVE TUTION FEE FOR SC & ST
            if ($students->community_id < 3 && $item->fee_sub_group_head_id == 2) {
                unset($feeStructure[$key]);
            }

            // REMOVE ADMISSION FEE FOR PwD
            if ($students->is_pwd == 1 && $item->fee_sub_group_head_id == 1) {
                unset($feeStructure[$key]);
            }

            // REMOVE TUTION FEE FOR PwD
            if ($students->is_pwd == 1 && $item->fee_sub_group_head_id == 2) {
                unset($feeStructure[$key]);
            }
        }

        return $feeStructure;
    }

    public function index()
    {

        // $feeGroup = FeeGroupHead::with('feeSubGroupHeads.feeStructures')->find(1);
        // foreach ($feeGroup->feeSubGroups as $feeSubGroup) {
        //     echo $feeSubGroup->name;

        //     foreach ($feeSubGroup->feeStructures as $feeStructure) {
        //         echo $feeStructure->name;
        //     }
        // }

        $fee_group_head = $this->fee_group_head;
        $course = $this->course;
        $grade = $this->grade;

        return view('dashboard.admin.FeeManagement.FeeStructure.FeeStructure', compact('fee_group_head', 'course', 'grade'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
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
