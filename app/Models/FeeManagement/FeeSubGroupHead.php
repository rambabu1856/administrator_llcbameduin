<?php

namespace App\Models\FeeManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\FeeManagement\FeeGroupHead;
use App\Models\FeeManagement\FeeStructure;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeSubGroupHead extends Model
{
    use HasFactory;

    public function feeGroupHead()
    {
        return $this->belongsTo(FeeGroupHead::class);
    }

    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class);
    }
}
