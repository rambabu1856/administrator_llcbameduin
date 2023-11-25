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
