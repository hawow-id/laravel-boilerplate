<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('field');
            $table->string('type');
            $table->unsignedSmallInteger('length')->default(0);
            $table->string('component')->nullable();
            $table->text('datasource')->nullable();
            $table->text('attributes')->nullable();
            $table->string('default_value')->nullable();
            $table->boolean('is_hidden')->default(false);
            $table->boolean('is_required')->default(true);
            $table->boolean('is_nullable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_details');
    }
}
