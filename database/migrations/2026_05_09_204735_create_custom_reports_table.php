<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('report_name');
            $table->text('description')->nullable();
            $table->json('selected_columns');
            $table->json('filters')->nullable();
            $table->json('group_by')->nullable();
            $table->json('sort_by')->nullable();
            $table->string('chart_type', 50)->nullable();
            $table->boolean('is_saved')->default(true);
            $table->timestamp('last_run_at')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('custom_reports');
    }
}
