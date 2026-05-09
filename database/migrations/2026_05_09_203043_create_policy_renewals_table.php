<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyRenewalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_renewals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('old_policy_id');
            $table->unsignedBigInteger('new_policy_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('renewal_date');
            $table->decimal('old_premium', 15, 2);
            $table->decimal('new_premium', 15, 2);
            $table->text('premium_change_reason')->nullable();
            $table->enum('renewal_method', ['manual', 'auto_renewal'])->default('manual');
            $table->string('payment_transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('old_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
            $table->foreign('new_policy_id')->references('id')->on('customer_policies')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policy_renewals');
    }
}
