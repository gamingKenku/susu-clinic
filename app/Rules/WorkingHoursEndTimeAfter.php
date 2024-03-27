<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WorkingHoursEndTimeAfter implements ValidationRule
{
    protected $start_time_array;
    public function __construct(array $start_time_array)
    {
        $this->start_time_array = $start_time_array;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $end_time_array, Closure $fail): void
    {
        for ($i = 0; $i <= 6; $i++)
        {
            if ($this->start_time_array[$i] && $this->start_time_array[$i] > $end_time_array[$i])
            {
                $fail('Значения полей :attribute должны быть позже начала работы.');
            }
        }
    }
}
