<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyDocumentShareLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_document_share_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_document_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('share_token')->unique();
            $table->string('password_hash')->nullable();
            $table->timestamp('expires_at');
            $table->integer('max_downloads')->nullable();
            $table->integer('download_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('policy_document_id', 'pd_share_fk')->references('id')->on('policy_documents')->onDelete('cascade');
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
        Schema::dropIfExists('policy_document_share_links');
    }
}
