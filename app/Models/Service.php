<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function discounts(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class, 'discounts_services_junc');
    }

    protected $table = 'services';
}
