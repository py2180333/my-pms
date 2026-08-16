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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id'); // Reference to the project
            $table->unsignedBigInteger('milestone_id')->nullable(); // Reference to a milestone, optional
            $table->string('task_name');
            $table->text('task_description')->nullable();
            $table->enum('status', ['To Do', 'In Progress', 'Completed'])->default('To Do');
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->string('dependencies')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Adds a 'deleted_at' column for soft deletes
            
            // Optional: Add foreign key constraints if you have related tables
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('milestone_id')->references('id')->on('milestones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
