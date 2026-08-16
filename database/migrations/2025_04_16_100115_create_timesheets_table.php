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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assigntask_id')->constrained('assigntasks')->onDelete('cascade');
            $table->date('date');
            $table->decimal('hours', 5, 2)->default(0);
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'approve', 'recheck', 'reject'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timesheets');
    }
};
