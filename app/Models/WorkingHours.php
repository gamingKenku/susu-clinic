<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkingHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekday',
        'start_time',
        'end_time',
        'staff_id',
    ];

    public function staff(): BelongsTo 
    {
        return $this->belongsTo(Staff::class);
    }

    protected $table = 'working_hours';
}
