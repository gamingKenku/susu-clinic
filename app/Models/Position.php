<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'responsibilities',
        'requirements',
        'conditions',
        'has_vacancy',
    ];

    public function staff(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'staff_positions_junc', 'position_id', 'staff_id');
    }

    // public function vacancies(): HasMany
    // {
    //     return $this->hasMany(Vacancy::class);
    // }

    protected $table = 'positions';
}
