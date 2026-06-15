<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_policy_id')->index();
            $table->unsignedBigInteger('commission_rate_id')->nullable();
            $table->string('channel_type', 50);
            $table->string('recipient_type', 50)->nullable(); // agent, broker, bancassurance_user, sfe_user
            $table->unsignedBigInteger('recipient_id')->nullable()->index();
            $table->decimal('premium_amount', 15, 2);
            $table->decimal('rate_value', 8, 4);
            $table->enum('rate_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('commission_amount', 15, 2);
            $table->string('status', 20)->default('pending'); // pending, approved, paid, cancelled
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
            $table->foreign('commission_rate_id')->references('id')->on('commission_rates')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_transactions');
    }
}
