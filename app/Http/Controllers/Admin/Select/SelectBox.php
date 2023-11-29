<?php

namespace App\Http\Controllers\Admin\Select;

use Carbon\Carbon;
use App\Models\Select\Batch;
use Illuminate\Http\Request;
use App\Models\Select\AcademicYear;
use App\Http\Controllers\Controller;
use App\Models\Accounts\Transaction;

class SelectBox extends Controller
{
  //  FETCH ALL BATCH
  public function getBatch(Request $request)
  {
    $batch = Batch::where('course_id', $request->id)->orderBy('title', 'desc');

    if ($request->isActive) {
      $batch = $batch->where('is_active', true);
    }

    $batch = $batch->get();
    return $batch;
  }

  // FETCH ALL GRADES
  public function getGrade(Request $request)
  {
    $academicYear = AcademicYear::with('grade')->where('batch_id', $request->batchId)
      ->get();

    return $academicYear;
  }

  // STUDENT PROMOTION :: FROM GRADE 
  // public function promoteStudentFromGrade(Request $request)
  // {
  //   $maxGrade = AcademicYear::max('grade_id');
  //   // From Grade
  //   $fromGrades = AcademicYear::with('grade')
  //     ->where('batch_id', $request->batchId)
  //     ->where('grade_id', '<', (int)$maxGrade)->get();
  //   return $fromGrades;
  // }

  // STUDENT PROMOTION :: TO GRADE 
  public function promoteToGrade(Request $request)
  {

    // To Grade
    $toGrades = AcademicYear::with('grade')
      ->where('batch_id', $request->batchId)
      ->where('grade_id', (int)$request->gradeId + 1)->get();

    return $toGrades;
  }

  public function getAcademicYearFromGradeAndBatch(Request $request)
  {

    if (!empty($request->gradeId)) {

      $academicYear = AcademicYear::with('year')->with('grade')->where('course_id', $request->courseId)->where('batch_id', $request->batchId)->where('grade_id', $request->gradeId)->first();

      $year = [];
      // dd(!empty($request->gradeId));

      if (!empty($academicYear)) {
        $year['fromAcademicYearId'] = $academicYear->id;
        $year['fromAcademicYearTitle'] = $academicYear->year->title;
        $year['isActive'] = 1; // TRUE
      } else {
        $year['isActive'] = 0; // False
      }
      return $year;
    }
  }

  public function getAcademicYear(Request $request)
  {
    $academicYear = AcademicYear::with('year')
      ->where('batch_id', $request->batchId)->get();
    return $academicYear;
  }


  public function getGradeFromAcademicYear(Request $request)

  {
    $academicYear = AcademicYear::with('grade')->where('batch_id', $request->batchId)
      ->where('id', $request->academicYearId)
      ->get();

    return $academicYear;
  }

  public function getSbcReferenceNumber(Request $request)
  {

    if ($request->feeReceiptFromDate && $request->feeReceiptToDate) {
      $from = Carbon::createFromFormat('d/m/Y', $request->feeReceiptFromDate)->format('Y-m-d');
      $to = Carbon::createFromFormat('d/m/Y', $request->feeReceiptToDate)->format('Y-m-d');
    } else {
      $from = $request->feeReceiptFromDate;
      $to = $request->feeReceiptToDate;
    }

    //1= 'Admission Fee' 2.  Examination Fee etc...
    $feeGroup =    $request->feeGroup;


    if ($request->sbcRefenceNumber) {

      $scbReferenceNumbers = Transaction::select('receipt_amount', 'transaction_date')
        ->where('transaction_reference_no', 'LIKE', $request->sbcRefenceNumber);

      return $scbReferenceNumbers->first();
    } else {

      $transaction = Transaction::where(function ($q) use ($request) {
        $q->where('student_name', 'like', '%' . $request->subStringOfName . '%')
          ->orWhere('enrollment_number', 'like', '%' . $request->enrollmentNumber . '%');
      })->where('mode_of_transaction_id', 2);

      if ($transaction->exists()) {
        // Fetch Single SBC
        $scbReferenceNumbers = $transaction->where('is_sbc_used', 0);

        if ($feeGroup > 0) {
          $scbReferenceNumbers = $scbReferenceNumbers->where('fee_group_head_id', $feeGroup);
        }
        if ($from) {
          $scbReferenceNumbers = $scbReferenceNumbers->whereBetween('transaction_date', [$from, $to]);
        }

        // $scbReferenceNumbers = $scbReferenceNumbers;
      } else {

        // Fetch All SBC
        $scbReferenceNumbers = Transaction::where('mode_of_transaction_id', 2)
          ->where('is_sbc_used', 0);

        if ($feeGroup > 0) {
          $scbReferenceNumbers = $scbReferenceNumbers->where('fee_group_head_id', $feeGroup);
        }

        if ($from) {
          $scbReferenceNumbers = $scbReferenceNumbers->whereBetween('transaction_date', [$from, $to]);
        }

        // $scbReferenceNumbers = $scbReferenceNumbers;
      }

      return $scbReferenceNumbers->get();
    }
  }
}
