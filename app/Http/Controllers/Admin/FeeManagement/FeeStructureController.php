<?php

namespace App\Http\Controllers\Admin\FeeManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FeeManagement\FeeGroupHead;

class FeeStructureController extends Controller
{

    public function index()
    {

        // $feeGroup = FeeGroupHead::with('feeSubGroupHeads.feeStructures')->find(1);
        // foreach ($feeGroup->feeSubGroups as $feeSubGroup) {
        //     echo $feeSubGroup->name;

        //     foreach ($feeSubGroup->feeStructures as $feeStructure) {
        //         echo $feeStructure->name;
        //     }
        // }



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
