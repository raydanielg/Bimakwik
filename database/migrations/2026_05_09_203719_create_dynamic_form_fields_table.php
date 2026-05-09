<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_form_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dynamic_form_id');
            $table->string('field_name');
            $table->string('field_label');
            $table->string('field_type');
            $table->boolean('is_required')->default(false);
            $table->json('validation_rules')->nullable();
            $table->json('options')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->foreign('dynamic_form_id')->references('id')->on('dynamic_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dynamic_form_fields');
    }
}
