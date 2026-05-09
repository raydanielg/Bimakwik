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
            $table->unsignedBigInteger('user_id');
            $table->enum('access_type', ['view', 'download', 'share', 'print']);
            $table->ipAddress('ip_address');
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->foreign('policy_document_id')->references('id')->on('policy_documents')->onDelete('cascade');
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
        Schema::dropIfExists('policy_document_access_logs');
    }
}
