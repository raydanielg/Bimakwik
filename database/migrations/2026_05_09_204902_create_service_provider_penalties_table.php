<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderPenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_penalties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_provider_id');
            $table->string('penalty_type', 50);
            $table->text('violation_description')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->integer('suspension_days')->nullable();
            $table->string('status', 50)->default('active');
            $table->unsignedBigInteger('issued_by')->nullable();
            $table->timestamp('issued_at')->useCurrent();
            $table->timestamps();

            $table->foreign('service_provider_id', 'pen_sp_fk')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('issued_by', 'pen_admin_fk')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_penalties');
    }
}
