<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'patronym',
        'specialities',
        'photo_path',
        'experience',
        'role_id'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function working_hours(): HasOne
    {
        return $this->hasOne(WorkingHours::class);
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'staff_positions_junc', 'staff_id', 'position_id');
    }

    protected $table = 'staff';
}
