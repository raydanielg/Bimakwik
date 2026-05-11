<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Indexes for users
        Schema::table('users', function (Blueprint $table) {
            $table->index('email', 'idx_users_email');
            $table->index('phone_number', 'idx_users_phone_number');
            $table->index('national_id', 'idx_users_national_id');
            $table->index('account_status', 'idx_users_account_status');
            $table->index('created_at', 'idx_users_created_at');
        });

        // Indexes for customers
        Schema::table('customers', function (Blueprint $table) {
            $table->index('customer_number', 'idx_customers_customer_number');
            $table->index('user_id', 'idx_customers_user_id');
            $table->index('kyc_status', 'idx_customers_kyc_status');
            $table->index('city', 'idx_customers_city');
            $table->index('region', 'idx_customers_region');
        });

        // Indexes for policies
        Schema::table('customer_policies', function (Blueprint $table) {
            $table->index('customer_id', 'idx_customer_policies_customer_id');
            $table->index('policy_number', 'idx_customer_policies_policy_number');
            $table->index('status', 'idx_customer_policies_status');
            $table->index('start_date', 'idx_customer_policies_start_date');
            $table->index('end_date', 'idx_customer_policies_end_date');
            $table->index('insurance_product_id', 'idx_customer_policies_product_id');
            $table->index('insurer_id', 'idx_customer_policies_insurer_id');
            $table->index('broker_id', 'idx_customer_policies_broker_id');
            $table->index('agent_id', 'idx_customer_policies_agent_id');
            // Composite
            $table->index(['customer_id', 'status'], 'idx_policies_customer_status');
            $table->index(['customer_id', 'end_date'], 'idx_policies_customer_end_date');
        });

        // Indexes for claims
        Schema::table('claims', function (Blueprint $table) {
            $table->index('customer_policy_id', 'idx_claims_policy_id');
            $table->index('customer_id', 'idx_claims_customer_id');
            $table->index('claim_number', 'idx_claims_claim_number');
            $table->index('status', 'idx_claims_status');
            $table->index('created_at', 'idx_claims_created_at');
            $table->index('fraud_alert', 'idx_claims_fraud_alert');
            // Composite
            $table->index(['customer_id', 'status'], 'idx_claims_customer_status');
        });

        // Indexes for wallet and payments
        Schema::table('wallets', function (Blueprint $table) {
            $table->index('user_id', 'idx_wallets_user_id');
        });

        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->index('wallet_id', 'idx_wallet_transactions_wallet_id');
            $table->index('transaction_reference', 'idx_wallet_transactions_transaction_reference');
            $table->index('created_at', 'idx_wallet_transactions_created_at');
            // Composite
            $table->index(['wallet_id', 'status'], 'idx_transactions_wallet_status');
        });

        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->index('customer_id', 'idx_payment_transactions_customer_id');
            $table->index('customer_policy_id', 'idx_payment_transactions_policy_id');
            $table->index('status', 'idx_payment_transactions_status');
        });

        // Indexes for brokers
        Schema::table('brokers', function (Blueprint $table) {
            $table->index('broker_number', 'idx_brokers_broker_number');
            $table->index('user_id', 'idx_brokers_user_id');
            $table->index('status', 'idx_brokers_status');
        });

        Schema::table('broker_commissions', function (Blueprint $table) {
            $table->index('broker_id', 'idx_broker_commissions_broker_id');
            $table->index('status', 'idx_broker_commissions_status');
        });

        // Indexes for aggregators
        Schema::table('aggregators', function (Blueprint $table) {
            $table->index('aggregator_number', 'idx_aggregators_aggregator_number');
            $table->index('user_id', 'idx_aggregators_user_id');
            $table->index('status', 'idx_aggregators_status');
        });

        Schema::table('aggregator_referral_links', function (Blueprint $table) {
            $table->index('aggregator_id', 'idx_aggregator_referral_links_aggregator_id');
            $table->index('link_token', 'idx_aggregator_referral_links_link_token');
        });

        // Indexes for agents
        Schema::table('agents', function (Blueprint $table) {
            $table->index('agent_number', 'idx_agents_agent_number');
            $table->index('user_id', 'idx_agents_user_id');
            $table->index('broker_id', 'idx_agents_broker_id');
            $table->index('insurer_id', 'idx_agents_insurer_id');
            $table->index('status', 'idx_agents_status');
        });

        // Indexes for service providers
        Schema::table('service_providers', function (Blueprint $table) {
            $table->index('provider_number', 'idx_service_providers_provider_number');
            $table->index('service_provider_type_id', 'idx_service_providers_provider_type_id');
            $table->index('status', 'idx_service_providers_status');
        });

        // Indexes for support tickets
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->index('customer_id', 'idx_support_tickets_customer_id');
            $table->index('ticket_number', 'idx_support_tickets_ticket_number');
            $table->index('status', 'idx_support_tickets_status');
            $table->index('priority', 'idx_support_tickets_priority');
            $table->index('created_at', 'idx_support_tickets_created_at');
            // Composite
            $table->index(['customer_id', 'status'], 'idx_support_tickets_customer_status');
        });

        // Indexes for AI and analytics
        Schema::table('ai_predictions', function (Blueprint $table) {
            $table->index(['entity_type', 'entity_id'], 'idx_ai_predictions_entity');
        });

        Schema::table('ai_product_recommendations', function (Blueprint $table) {
            $table->index('customer_id', 'idx_ai_product_recommendations_customer_id');
        });

        Schema::table('ai_fraud_detection_results', function (Blueprint $table) {
            $table->index('claim_id', 'idx_ai_fraud_detection_results_claim_id');
        });

        // Indexes for renewals
        Schema::table('policy_renewals', function (Blueprint $table) {
            $table->index('old_policy_id', 'idx_policy_renewals_old_policy_id');
            $table->index('new_policy_id', 'idx_policy_renewals_new_policy_id');
            $table->index('customer_id', 'idx_policy_renewals_customer_id');
            $table->index('renewal_date', 'idx_policy_renewals_renewal_date');
        });

        // Indexes for documents
        Schema::table('policy_documents', function (Blueprint $table) {
            $table->index('customer_policy_id', 'idx_policy_documents_policy_id');
            $table->index('customer_id', 'idx_policy_documents_customer_id');
            $table->index('document_type', 'idx_policy_documents_document_type');
        });

        // Indexes for products
        Schema::table('insurance_products', function (Blueprint $table) {
            $table->index('policy_category_id', 'idx_insurance_products_category_id');
            $table->index('insurer_id', 'idx_insurance_products_insurer_id');
            $table->index('is_active', 'idx_insurance_products_is_active');
            $table->index('product_code', 'idx_insurance_products_product_code');
        });

        // Indexes for regulators
        if (Schema::hasColumn('regulators', 'user_id')) {
            Schema::table('regulators', function (Blueprint $table) {
                $table->index('user_id', 'idx_regulators_user_id');
            });
        }

        Schema::table('regulator_reports', function (Blueprint $table) {
            $table->index('created_at', 'idx_regulator_reports_submitted_at');
        });

        // Indexes for workflow
        Schema::table('workflow_executions', function (Blueprint $table) {
            $table->index('workflow_id', 'idx_workflow_executions_workflow_id');
            $table->index(['entity_type', 'entity_id'], 'idx_workflow_executions_entity');
            $table->index('status', 'idx_workflow_executions_status');
        });

        // Indexes for financing
        Schema::table('financing_loans', function (Blueprint $table) {
            $table->index('customer_id', 'idx_financing_loans_customer_id');
            $table->index('customer_policy_id', 'idx_financing_loans_policy_id');
            $table->index('status', 'idx_financing_loans_status');
        });

        Schema::table('financing_repayment_schedules', function (Blueprint $table) {
            $table->index('financing_loan_id', 'idx_financing_repayment_schedules_loan_id');
            $table->index('status', 'idx_financing_repayment_schedules_status');
        });

        // Indexes for API and developer
        Schema::table('developer_api_keys', function (Blueprint $table) {
            $table->index('api_key', 'idx_developer_api_keys_api_key');
            $table->index('developer_app_id', 'idx_developer_api_keys_developer_app_id');
        });

        Schema::table('api_usage_statistics', function (Blueprint $table) {
            $table->index('developer_api_key_id', 'idx_api_usage_statistics_api_key_id');
            $table->index('date', 'idx_api_usage_statistics_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop indexes for major tables
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('idx_users_email');
            $table->dropIndex('idx_users_phone_number');
        });
        // ... other drop commands if necessary, but fresh migration handles this
    }
}
