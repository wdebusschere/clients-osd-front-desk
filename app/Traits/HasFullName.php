<?php

namespace App\Traits;

trait HasFullName
{
    /**
     * Returns the user's short name.
     */
    public function getShortNameAttribute()
    {
        $names = explode(' ', $this->name);

        $firstName = array_shift($names);
        $lastName = last($names);

        return $firstName.(! empty($lastName) ? ' '.$lastName : '');
    }
}
