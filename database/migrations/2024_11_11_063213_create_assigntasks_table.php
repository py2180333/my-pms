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
        Schema::create('assigntasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade'); // assumes 'projects' table exists
            $table->foreignId('milestone_id')->nullable()->constrained('milestones')->onDelete('set null'); // assumes 'milestones' table exists
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('cascade'); // assumes 'tasks' table exists
            //$table->foreignId('assignteam_id')->nullable()->constrained('assignteams')->onDelete('set null'); // assumes 'assignteams' table exists
            $table->foreignId('consultant_id')->nullable()->constrained('resources')->onDelete('set null'); // assumes 'resources' table exists
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigntasks');
    }
};
