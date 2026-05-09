<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurance_product_id');
            $table->string('form_name');
            $table->json('form_schema');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('insurance_product_id')->references('id')->on('insurance_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dynamic_forms');
    }
}
