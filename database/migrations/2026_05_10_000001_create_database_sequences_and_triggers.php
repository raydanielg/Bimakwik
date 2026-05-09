<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDatabaseSequencesAndTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Create Sequences
        DB::unprepared("
            CREATE SEQUENCE IF NOT EXISTS seq_customer_number START 100000;
            CREATE SEQUENCE IF NOT EXISTS seq_policy_number START 1000000;
            CREATE SEQUENCE IF NOT EXISTS seq_claim_number START 100000;
            CREATE SEQUENCE IF NOT EXISTS seq_ticket_number START 100000;
            CREATE SEQUENCE IF NOT EXISTS seq_cover_note_number START 100000;
            CREATE SEQUENCE IF NOT EXISTS seq_broker_number START 10000;
            CREATE SEQUENCE IF NOT EXISTS seq_aggregator_number START 10000;
            CREATE SEQUENCE IF NOT EXISTS seq_agent_number START 10000;
            CREATE SEQUENCE IF NOT EXISTS seq_provider_number START 10000;
            CREATE SEQUENCE IF NOT EXISTS seq_loan_number START 10000;
        ");

        // 2. Create Functions
        DB::unprepared("
            CREATE OR REPLACE FUNCTION generate_customer_number()
            RETURNS TRIGGER AS $$
            BEGIN
                NEW.customer_number := 'CUST' || LPAD(nextval('seq_customer_number')::TEXT, 8, '0');
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE OR REPLACE FUNCTION generate_policy_number()
            RETURNS TRIGGER AS $$
            BEGIN
                NEW.policy_number := 'POL' || TO_CHAR(CURRENT_TIMESTAMP, 'YYYY') || LPAD(nextval('seq_policy_number')::TEXT, 8, '0');
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE OR REPLACE FUNCTION generate_claim_number()
            RETURNS TRIGGER AS $$
            BEGIN
                NEW.claim_number := 'CLM' || TO_CHAR(CURRENT_TIMESTAMP, 'YYYYMMDD') || LPAD(nextval('seq_claim_number')::TEXT, 6, '0');
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE OR REPLACE FUNCTION generate_ticket_number()
            RETURNS TRIGGER AS $$
            BEGIN
                NEW.ticket_number := 'SUP' || TO_CHAR(NOW(), 'YYYY') || LPAD(nextval('seq_ticket_number')::TEXT, 6, '0');
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        // 3. Attach Triggers
        DB::unprepared("
            DROP TRIGGER IF EXISTS trigger_generate_customer_number ON customers;
            CREATE TRIGGER trigger_generate_customer_number
                BEFORE INSERT ON customers
                FOR EACH ROW
                WHEN (NEW.customer_number IS NULL)
                EXECUTE FUNCTION generate_customer_number();

            DROP TRIGGER IF EXISTS trigger_generate_policy_number ON customer_policies;
            CREATE TRIGGER trigger_generate_policy_number
                BEFORE INSERT ON customer_policies
                FOR EACH ROW
                WHEN (NEW.policy_number IS NULL)
                EXECUTE FUNCTION generate_policy_number();

            DROP TRIGGER IF EXISTS trigger_generate_claim_number ON claims;
            CREATE TRIGGER trigger_generate_claim_number
                BEFORE INSERT ON claims
                FOR EACH ROW
                WHEN (NEW.claim_number IS NULL)
                EXECUTE FUNCTION generate_claim_number();

            DROP TRIGGER IF EXISTS trigger_generate_ticket_number ON support_tickets;
            CREATE TRIGGER trigger_generate_ticket_number
                BEFORE INSERT ON support_tickets
                FOR EACH ROW
                WHEN (NEW.ticket_number IS NULL)
                EXECUTE FUNCTION generate_ticket_number();
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_gen_ticket_number;");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_gen_claim_number;");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_gen_policy_number;");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_gen_customer_number;");
        Schema::dropIfExists('sys_sequences');
    }
}
