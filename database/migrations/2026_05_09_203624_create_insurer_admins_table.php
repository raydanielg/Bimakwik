<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurerAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurer_admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurer_id');
            $table->unsignedBigInteger('user_id');
            $table->string('role')->default('admin');
            $table->json('permissions')->nullable();
            $table->timestamps();

            $table->foreign('insurer_id')->references('id')->on('insurers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['insurer_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurer_admins');
    }
}
