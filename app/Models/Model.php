<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * This class contains shared setup, properties and methods
 * of all application models
 *
 */
class Model extends EloquentModel
{
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected function commonSortSetting($query, $sortable, $orderBy, $sortOrder, $defaultKey)
    {
        foreach ($sortable as $key => $value) {
            if (is_int($key)) {
                if ($value === $orderBy) {
                    $sortOrder = (strtolower($sortOrder) != 'desc') ? 'asc' : 'desc';
                    return $query->orderBy($orderBy, $sortOrder);
                }
            }
        }
        return $query->orderBy($defaultKey);
    }
}
