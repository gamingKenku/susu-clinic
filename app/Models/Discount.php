<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'markup',
        'start_date',
        'end_date'
    ];

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'discounts_services_junc');
    }

    protected $table = 'discounts';
}
