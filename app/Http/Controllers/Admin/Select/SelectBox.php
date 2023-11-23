<?php

namespace App\Http\Controllers\Admin\Select;

use App\Http\Controllers\Controller;
use App\Models\Select\AcademicYear;
use App\Models\Select\Batch;
use Illuminate\Http\Request;

class SelectBox extends Controller
{
    public function getBatch(Request $request)
    {
        $batch = Batch::where('course_id', $request->id)->orderBy('title', 'desc')->get();
        return $batch;
    }

    public function getAcademicYear(Request $request)
    {
        $academicYear = AcademicYear::with('year')
            ->where('batch_id', $request->batchId)->get();
        return $academicYear;
    }


    public function getAcademicYearGrade(Request $request)

    {
        $academicYear = AcademicYear::with('grade')->where('batch_id', $request->batchId)
            ->where('id', $request->academicYearId)
            ->get();

        return $academicYear;
    }
}
