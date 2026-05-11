<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiumFinancingPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('partner_code', 50)->unique();
            $table->string('partner_name');
            $table->string('registration_number')->nullable();
            $table->string('tin', 50)->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->string('logo_url', 500)->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->integer('max_loan_term_months')->nullable();
            $table->decimal('min_loan_amount', 15, 2)->nullable();
            $table->decimal('max_loan_amount', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('status', 50)->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_partners');
    }
}
