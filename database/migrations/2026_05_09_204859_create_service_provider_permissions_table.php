<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_provider_id');
            $table->string('permission_key', 100);
            $table->boolean('is_allowed')->default(false);
            $table->unsignedBigInteger('granted_by')->nullable();
            $table->timestamps();

            $table->foreign('service_provider_id', 'perm_sp_fk')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('granted_by', 'perm_admin_fk')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_permissions');
    }
}
