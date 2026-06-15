<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTiramisCodesToEntities extends Migration
{
    public function up()
    {
        // Insurers - company_code (TIRA-assigned)
        Schema::table('insurers', function (Blueprint $table) {
            $table->string('company_code', 50)->nullable()->unique()->after('insurer_code');
            $table->string('sales_code', 50)->nullable()->after('company_code');
            $table->string('tiramis_api_key', 255)->nullable()->after('sales_code');
            $table->boolean('tiramis_enabled')->default(false)->after('tiramis_api_key');
            $table->timestamp('tiramis_last_sync_at')->nullable()->after('tiramis_enabled');
        });

        // Brokers - sales_code
        Schema::table('brokers', function (Blueprint $table) {
            $table->string('company_code', 50)->nullable()->after('license_number');
            $table->string('sales_code', 50)->nullable()->unique()->after('company_code');
            $table->boolean('tiramis_enabled')->default(false)->after('sales_code');
        });

        // Agents (includes SFE and Bancassurance via agent_type) - sales_code
        Schema::table('agents', function (Blueprint $table) {
            $table->string('company_code', 50)->nullable()->after('tin');
            $table->string('sales_code', 50)->nullable()->unique()->after('company_code');
            $table->boolean('tiramis_enabled')->default(false)->after('sales_code');
        });

        // Service Providers - company_code
        Schema::table('service_providers', function (Blueprint $table) {
            $table->string('company_code', 50)->nullable()->after('registration_number');
            $table->string('sales_code', 50)->nullable()->after('company_code');
        });

        // Enhance tir_amis_reports with company/sales codes
        Schema::table('tir_amis_reports', function (Blueprint $table) {
            $table->string('company_code', 50)->nullable()->after('claim_id');
            $table->string('sales_code', 50)->nullable()->after('company_code');
            $table->string('report_type', 50)->default('claims')->after('sales_code');
            $table->string('submitted_by_type', 50)->nullable()->after('report_type');
            $table->unsignedBigInteger('submitted_by_id')->nullable()->after('submitted_by_type');
            $table->index('company_code');
            $table->index('report_type');
        });

        // Enhance tir_amis_integration_logs
        Schema::table('tir_amis_integration_logs', function (Blueprint $table) {
            $table->string('action', 100)->nullable();
            $table->string('entity_type', 50)->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('company_code', 50)->nullable();
            $table->string('sales_code', 50)->nullable();
            $table->string('status', 50)->default('pending');
            $table->text('request_payload')->nullable();
            $table->text('response_payload')->nullable();
            $table->integer('http_status_code')->nullable();
            $table->text('error_message')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->index(['entity_type', 'entity_id']);
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::table('insurers', function (Blueprint $table) {
            $table->dropColumn(['company_code', 'sales_code', 'tiramis_api_key', 'tiramis_enabled', 'tiramis_last_sync_at']);
        });
        Schema::table('brokers', function (Blueprint $table) {
            $table->dropColumn(['company_code', 'sales_code', 'tiramis_enabled']);
        });
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn(['company_code', 'sales_code', 'tiramis_enabled']);
        });
        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropColumn(['company_code', 'sales_code']);
        });
        Schema::table('tir_amis_reports', function (Blueprint $table) {
            $table->dropIndex(['company_code']);
            $table->dropIndex(['report_type']);
            $table->dropColumn(['company_code', 'sales_code', 'report_type', 'submitted_by_type', 'submitted_by_id']);
        });
        Schema::table('tir_amis_integration_logs', function (Blueprint $table) {
            $table->dropIndex(['entity_type', 'entity_id']);
            $table->dropIndex(['status']);
            $table->dropColumn(['action', 'entity_type', 'entity_id', 'company_code', 'sales_code', 'status', 'request_payload', 'response_payload', 'http_status_code', 'error_message', 'ip_address']);
        });
    }
}
