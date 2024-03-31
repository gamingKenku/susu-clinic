<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HasStartTime implements ValidationRule
{
    protected $end_time;
    public function __construct($end_time)
    {
        $this->end_time = $end_time;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $start_time, Closure $fail): void
    {
        if ($this->end_time && !$start_time)
        {
            $fail('Нехватает времени конца работы для :attribute.');
        }
    }
}
