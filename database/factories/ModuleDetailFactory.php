<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\ModuleDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModuleDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'module_id' => Module::factory(),
            'field' => 'name',
            'type' => 'varchar',
            'length' => 50,
            'is_hidden' => false,
            'component' => 'form.input',
            'attributes' => null,
            'default_value' => null,
            'is_required' => true,
            'is_nullable' => true,
        ];
    }
}
