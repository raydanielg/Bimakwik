<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliance_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable(); // e.g., 'policy_issue', 'claims_delay', 'reporting_violation'
            $table->string('severity')->default('medium'); // critical, high, medium, low
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('entity_type')->nullable(); // e.g., 'insurer', 'broker', 'claim'
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('status')->default('open'); // open, resolved, dismissed
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compliance_alerts');
    }
};
