<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancingPartnerAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_partner_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financing_partner_id');
            $table->string('agreement_number', 100)->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('revenue_share_percentage', 5, 2)->nullable();
            $table->string('document_url', 500)->nullable();
            $table->json('terms')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();

            $table->foreign('financing_partner_id', 'fpa_partner_fk')->references('id')->on('financing_partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_partner_agreements');
    }
}
