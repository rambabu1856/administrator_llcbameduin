<?php

namespace App\Models\FeeManagement;

use App\Models\Select\Batch;
use App\Models\Select\Grade;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeeManagement\FeeGroupHead;
use App\Models\FeeManagement\FeeSubGroupHead;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeStructure extends Model
{
    use HasFactory;

    public function feeSubGroupHead()
    {
        return $this->belongsTo(FeeSubGroupHead::class);
    }

    public function feeGroupHead()
    {
        return $this->belongsTo(FeeGroupHead::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
