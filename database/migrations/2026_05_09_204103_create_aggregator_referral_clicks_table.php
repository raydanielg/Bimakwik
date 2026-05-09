<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatorReferralClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregator_referral_clicks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aggregator_referral_link_id');
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('referrer_url', 500)->nullable();
            $table->timestamps();

            $table->foreign('aggregator_referral_link_id', 'arl_click_fk')->references('id')->on('aggregator_referral_links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aggregator_referral_clicks');
    }
}
