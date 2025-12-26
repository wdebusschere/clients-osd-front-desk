<?php

namespace App\Models;

use App\Enums\CrudOpEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity as SpatieActivity;

class Activity extends SpatieActivity
{
    use HasFactory;

    protected $table = 'activity_log';

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get the translated description.
     */
    public function description(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value === null) {
                    return null;
                }

                try {
                    return CrudOpEnum::from($value)->toStr();
                } catch (\ValueError $e) {
                    // Handle the case where the value is not a valid enum value
                    return $value;
                }
            },
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope a query to only include filtered results.
     *
     * @param  Builder  $query
     * @param $value
     */
    public function scopeSearch(Builder $query, $value)
    {
        $query->where('id', $value)
            ->orWhere('description', 'LIKE', "%{$value}%");
    }

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    */

    /**
     * Get the resource name.
     *
     * @return string
     */
    public function getResourceName()
    {
        $modelNameBits = explode('\\', $this->subject_type);
        $modelName = end($modelNameBits);
        $resourceName = Str::plural(Str::snake($modelName));

        return $resourceName;
    }
}
