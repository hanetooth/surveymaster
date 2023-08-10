<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('text')->comment('The question text itself.');
            $table->string('hint')->nullable()->comment(
                'Placeholder or small label'
            );
            $table->unsignedBigInteger('component_id');
            $table->boolean('is_required')->default(false)->comment(
                'Whether the question is required to be answered or not.'
            );
            $table->unsignedBigInteger('form_id');
            $table->integer('form_version');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
