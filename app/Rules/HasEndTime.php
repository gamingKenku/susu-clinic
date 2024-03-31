<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HasEndTime implements ValidationRule
{
    protected $start_time;
    public function __construct($start_time)
    {
        $this->start_time = $start_time;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $end_time, Closure $fail): void
    {
        if ($this->start_time && !$end_time)
        {
            $fail('Нехватает времени начала работы для :attribute');
        }
    }
}
