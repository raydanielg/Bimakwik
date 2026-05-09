<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ai_models', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->string('model_type', 50);
            $table->string('version', 50)->nullable();
            $table->string('model_path', 500)->nullable();
            $table->decimal('accuracy_score', 5, 4)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('deployed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ai_models');
    }
}
