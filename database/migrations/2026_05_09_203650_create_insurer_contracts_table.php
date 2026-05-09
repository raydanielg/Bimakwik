<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurerContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurer_contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurer_id');
            $table->string('contract_number')->unique();
            $table->string('contract_type')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('document_url')->nullable();
            $table->json('terms')->nullable();
            $table->string('status')->default('active');
            $table->timestamp('signed_at')->nullable();
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
        Schema::dropIfExists('insurer_contracts');
    }
}
