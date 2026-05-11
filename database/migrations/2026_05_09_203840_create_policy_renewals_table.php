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
            $table->unsignedBigInteger('new_policy_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamp('renewal_date');
            $table->decimal('old_premium', 15, 2);
            $table->decimal('new_premium', 15, 2);
            $table->decimal('premium_change_percentage', 5, 2)->virtualAs('((new_premium - old_premium) / NULLIF(old_premium, 0) * 100)');
            $table->text('premium_change_reason')->nullable();
            $table->string('renewal_method', 50);
            $table->string('payment_transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('old_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
            $table->foreign('new_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
