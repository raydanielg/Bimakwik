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
        // For SQLite, we simulate sequences using a dedicated metadata table
        Schema::create('sys_sequences', function (Blueprint $table) {
            $table->string('name')->primary();
            $table->bigInteger('current_value');
        });

        $sequences = [
            'seq_customer_number' => 100000,
            'seq_policy_number' => 1000000,
            'seq_claim_number' => 100000,
            'seq_ticket_number' => 100000,
            'seq_cover_note_number' => 100000,
            'seq_broker_number' => 10000,
            'seq_aggregator_number' => 10000,
            'seq_agent_number' => 10000,
            'seq_provider_number' => 10000,
            'seq_loan_number' => 10000,
        ];

        foreach ($sequences as $name => $start) {
            DB::table('sys_sequences')->insert(['name' => $name, 'current_value' => $start]);
        }

        // Create triggers for SQLite
        DB::unprepared("
            CREATE TRIGGER trg_gen_customer_number AFTER INSERT ON customers
            BEGIN
                UPDATE sys_sequences SET current_value = current_value + 1 WHERE name = 'seq_customer_number';
                UPDATE customers 
                SET customer_number = 'CUST' || printf('%08d', (SELECT current_value FROM sys_sequences WHERE name = 'seq_customer_number'))
                WHERE id = NEW.id AND customer_number IS NULL;
            END;

            CREATE TRIGGER trg_gen_policy_number AFTER INSERT ON customer_policies
            BEGIN
                UPDATE sys_sequences SET current_value = current_value + 1 WHERE name = 'seq_policy_number';
                UPDATE customer_policies 
                SET policy_number = 'POL' || strftime('%Y', 'now') || printf('%08d', (SELECT current_value FROM sys_sequences WHERE name = 'seq_policy_number'))
                WHERE id = NEW.id AND policy_number IS NULL;
            END;

            CREATE TRIGGER trg_gen_claim_number AFTER INSERT ON claims
            BEGIN
                UPDATE sys_sequences SET current_value = current_value + 1 WHERE name = 'seq_claim_number';
                UPDATE claims 
                SET claim_number = 'CLM' || strftime('%Y%m%d', 'now') || printf('%06d', (SELECT current_value FROM sys_sequences WHERE name = 'seq_claim_number'))
                WHERE id = NEW.id AND claim_number IS NULL;
            END;

            CREATE TRIGGER trg_gen_ticket_number AFTER INSERT ON support_tickets
            BEGIN
                UPDATE sys_sequences SET current_value = current_value + 1 WHERE name = 'seq_ticket_number';
                UPDATE support_tickets 
                SET ticket_number = 'SUP' || strftime('%Y', 'now') || printf('%06d', (SELECT current_value FROM sys_sequences WHERE name = 'seq_ticket_number'))
                WHERE id = NEW.id AND ticket_number IS NULL;
            END;
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
