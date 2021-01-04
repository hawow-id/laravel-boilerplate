<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->hasPosts(10)->create();
         $module = \App\Models\Module::factory([
             'name' => 'posts',  'table' => 'posts',
         ])->create();
         $moduleDetails = [
             [
                 'field' => 'title',
                 'module_id' => $module,
             ],[
                 'field' => 'sub_title',
                 'module_id' => $module,
             ],[
                 'field' => 'content',
                 'component' => 'form.textarea',
                 'module_id' => $module,
             ],[
                 'field' => 'author_id',
                 'module_id' => $module,
             ],[
                 'field' => 'updated_at',
                 'module_id' => $module,
             ],[
                 'field' => 'created_at',
                 'module_id' => $module,
             ],
         ];
        foreach ($moduleDetails as $moduleDetail) {
            \App\Models\ModuleDetail::factory($moduleDetail)->create();
        }
    }
}
