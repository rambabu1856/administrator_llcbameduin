<?php

namespace App\Models\FeeManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\FeeManagement\FeeSubGroupHead;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeGroupHead extends Model
{
    use HasFactory;

    public function feeSubGroupHeads()
    {
        return $this->hasMany(FeeSubGroupHead::class);
    }
}
