<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'category_id'
    ];

    public function discounts(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class, 'discounts_services_junc');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected $table = 'services';
}
