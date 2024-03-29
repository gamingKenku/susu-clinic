<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        'clinic_id'
    ];

    public function clinic(): BelongsTo 
    {
        return $this->belongsTo(Clinic::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    protected $table = 'categories';
}
