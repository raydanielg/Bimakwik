<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_policy_id');
            $table->unsignedBigInteger('user_id');
            $table->string('document_type');
            $table->string('document_name');
            $table->string('document_name_sw')->nullable();
            $table->string('file_name');
            $table->string('file_url', 500);
            $table->string('file_hash')->nullable();
            $table->integer('file_size_bytes');
            $table->string('mime_type')->default('application/pdf');
            $table->json('metadata')->nullable();
            $table->boolean('is_generated')->default(false);
            $table->timestamp('generated_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
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
        Schema::dropIfExists('policy_documents');
    }
}
