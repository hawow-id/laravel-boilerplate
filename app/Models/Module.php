<?php

namespace App\Models;

/**
 * Class Module
 * @package App\Models
 * @property-read int id
 * @property-read string name
 * @property-read string table
 * @property-read ModuleDetail[] moduleDetails
 */
class Module extends BaseModel
{
    protected $fillable = [
        'name', 'table',
    ];

    public function moduleDetails()
    {
        return $this->hasMany(ModuleDetail::class);
    }
}
