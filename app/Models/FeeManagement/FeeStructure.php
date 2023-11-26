<?php

namespace App\Models\FeeManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeeManagement\FeeSubGroupHead;

class FeeStructure extends Model
{
    use HasFactory;

    public function feeSubGroupHead()
    {
        return $this->belongsTo(feeSubGroupHead::class);
    }
}
