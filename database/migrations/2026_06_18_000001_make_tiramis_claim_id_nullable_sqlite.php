<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeTiramisClaimIdNullableSqlite extends Migration
{
    public function up()
    {
        // SQLite does not support altering columns directly, so we recreate the table
        $columns = DB::select('PRAGMA table_info(tir_amis_reports)');
        if (collect($columns)->firstWhere('name', 'claim_id')) {
            DB::statement('ALTER TABLE tir_amis_reports RENAME TO tir_amis_reports_old');
            
            DB::statement('
                CREATE TABLE tir_amis_reports (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    claim_id INTEGER UNSIGNED NULL,
                    report_number VARCHAR(255) NOT NULL UNIQUE,
                    report_data TEXT NOT NULL,
                    status VARCHAR(255) NOT NULL DEFAULT "pending",
                    sent_at DATETIME NULL,
                    response_code VARCHAR(255) NULL,
                    response_message TEXT NULL,
                    created_at DATETIME NULL,
                    updated_at DATETIME NULL,
                    company_code VARCHAR(255) NULL,
                    sales_code VARCHAR(255) NULL,
                    report_type VARCHAR(255) NULL,
                    submitted_by_type VARCHAR(255) NULL,
                    submitted_by_id INTEGER UNSIGNED NULL
                )
            ');
            
            DB::statement('
                INSERT INTO tir_amis_reports 
                SELECT id, claim_id, report_number, report_data, status, sent_at, response_code, response_message, created_at, updated_at, company_code, sales_code, report_type, submitted_by_type, submitted_by_id
                FROM tir_amis_reports_old
            ');
            
            DB::statement('DROP TABLE tir_amis_reports_old');
        }
    }

    public function down()
    {
        // Reverse is complex; skipping for dev environment
    }
}
