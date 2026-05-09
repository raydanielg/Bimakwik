<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyDocumentAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_document_access_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_document_id');
            $table->unsignedBigInteger('customer_policy_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('accessed_by');
            $table->string('access_type', 50);
            $table->ipAddress('ip_address');
            $table->text('user_agent')->nullable();
            $table->string('share_link_token')->nullable();
            $table->timestamps();

            $table->foreign('policy_document_id')->references('id')->on('policy_documents')->onDelete('cascade');
            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('accessed_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policy_document_access_logs');
    }
}
