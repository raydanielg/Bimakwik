<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyNomineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_nominees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_policy_id');
            $table->string('nominee_name');
            $table->string('nominee_relationship', 100);
            $table->string('nominee_phone', 20)->nullable();
            $table->string('nominee_national_id', 50)->nullable();
            $table->decimal('percentage_share', 5, 2)->default(100.00);
            $table->timestamps();

            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policy_nominees');
    }
}
