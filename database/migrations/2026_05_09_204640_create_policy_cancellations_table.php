<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyCancellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_cancellations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_policy_id')->unique();
            $table->date('cancellation_date');
            $table->string('reason_code', 50)->nullable();
            $table->text('reason')->nullable();
            $table->decimal('refund_amount', 15, 2)->nullable();
            $table->boolean('refund_paid')->default(false);
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamps();

            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
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
        Schema::dropIfExists('policy_cancellations');
    }
}
