<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingPartnerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_partner_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financing_partner_id')->unique();
            $table->integer('years_in_business')->nullable();
            $table->integer('total_clients')->nullable();
            $table->decimal('total_disbursed_amount', 15, 2)->nullable();
            $table->decimal('default_rate', 5, 2)->nullable();
            $table->json('certifications')->nullable();
            $table->timestamps();

            $table->foreign('financing_partner_id', 'fpp_partner_fk')->references('id')->on('financing_partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_partner_profiles');
    }
}
