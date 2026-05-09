<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyc_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kyc_submission_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('document_type', ['national_id_front', 'national_id_back', 'passport_photo', 'proof_of_address', 'selfie']);
            $table->string('file_name');
            $table->string('file_url', 500);
            $table->string('file_hash')->nullable();
            $table->integer('file_size');
            $table->string('mime_type');
            $table->boolean('is_verified')->default(false);
            $table->text('verification_notes')->nullable();
            $table->timestamps();

            $table->foreign('kyc_submission_id')->references('id')->on('kyc_submissions')->onDelete('cascade');
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
        Schema::dropIfExists('kyc_documents');
    }
}
