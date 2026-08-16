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
        Schema::create('milestones', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('project_id');
        $table->string('milestone_name');
        $table->date('milestone_date');
        $table->date('forecasting_date')->nullable();
        $table->string('status');
        $table->text('description')->nullable(); // pr change 23-9-25
        $table->softDeletes(); // For soft deletes
        $table->timestamps();

        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};
