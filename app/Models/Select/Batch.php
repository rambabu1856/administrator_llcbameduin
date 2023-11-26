<?php

namespace App\Models\Select;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\FeeManagement\FeeStructure;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Batch extends Model
{
    use HasFactory;
    use Notifiable;

    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class);
    }
}
