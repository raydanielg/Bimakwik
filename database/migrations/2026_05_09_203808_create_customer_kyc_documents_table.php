<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerKycDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_kyc_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_kyc_submission_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('document_type', 50);
            $table->string('file_name');
            $table->string('file_url', 500);
            $table->string('file_hash');
            $table->integer('file_size_bytes');
            $table->string('mime_type', 100);
            $table->boolean('is_verified')->default(false);
            $table->text('verification_notes')->nullable();
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps();

            $table->foreign('customer_kyc_submission_id')->references('id')->on('customer_kyc_submissions')->onDelete('cascade');
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
        Schema::dropIfExists('customer_kyc_documents');
    }
}
