<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenewalReminderLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewal_reminder_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_policy_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('days_before_expiry');
            $table->date('reminder_date');
            $table->string('channel_sent', 50);
            $table->string('status', 50)->default('sent');
            $table->timestamps();

            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
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
        Schema::dropIfExists('renewal_reminder_logs');
    }
}
