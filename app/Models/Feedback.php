<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'author',
        'rating',
        'mail',
        'moderated',
        'blocked',
        'confirmed',
        'confirmation_token'
    ];

    protected $table = 'feedback';
}
