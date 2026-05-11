<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyEndorsementHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_endorsement_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_endorsement_id');
            $table->string('action', 50);
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('policy_endorsement_id', 'pe_hist_fk')->references('id')->on('policy_endorsements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policy_endorsement_histories');
    }
}
