<?php

namespace App\Models;

/**
 * Class ModuleDetail
 * @package App\Models
 * @property-read int id
 * @property-read Module module
 * @property-read int module_id
 * @property-read string field
 * @property-read int length
 * @property-read string type
 * @property-read boolean is_hidden
 * @property-read boolean is_required
 * @property-read boolean is_nullable
 * @property-read ?string component
 * @property-read ?string datasource
 * @property-read ?array attributes
 * @property-read ?string default_value
 */
class ModuleDetail extends BaseModel
{
    protected $fillable = [
        'module_id', 'field', 'length',
        'type', 'is_hidden', 'component',
        'attributes', 'default_value', 'datasource',
        'is_nullable', 'is_required',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
