<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentCommissionWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_commission_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->decimal('amount', 15, 2);
            $table->string('withdrawal_method', 50);
            $table->string('destination');
            $table->string('status', 50)->default('pending');
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->string('reference_number', 100)->nullable();
            $table->timestamps();

            $table->foreign('agent_id', 'agent_cw_agent_fk')->references('id')->on('agents')->onDelete('cascade');
            $table->foreign('processed_by', 'agent_cw_admin_fk')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_commission_withdrawals');
    }
}
