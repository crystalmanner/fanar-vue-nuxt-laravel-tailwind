<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CheckImage implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $size;

    public function __construct($size)
    {
        $this->size = $size;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!Storage::exists($value))
            return false;

        if (\File::size(Storage::path($value)) > $this->size * 1024 * 1024)
            return false;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'please select a valid image';
    }
}
