<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'responsibilities',
        'requirements',
        'conditions',
    ];
    
    public function Position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    protected $table = 'vacancies';
}
