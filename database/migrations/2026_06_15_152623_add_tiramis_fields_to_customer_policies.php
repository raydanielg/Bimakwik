<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTiramisFieldsToCustomerPolicies extends Migration
{
    public function up()
    {
        Schema::table('customer_policies', function (Blueprint $table) {
            $table->string('company_code', 50)->nullable()->after('insurer_id');
            $table->string('sale_point_code', 50)->nullable()->after('company_code');
        });
    }

    public function down()
    {
        Schema::table('customer_policies', function (Blueprint $table) {
            $table->dropColumn(['company_code', 'sale_point_code']);
        });
    }
}
