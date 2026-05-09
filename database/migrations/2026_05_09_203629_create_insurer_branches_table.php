<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurerBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurer_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurer_id');
            $table->string('branch_code');
            $table->string('branch_name');
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('manager_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('insurer_id')->references('id')->on('insurers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurer_branches');
    }
}
