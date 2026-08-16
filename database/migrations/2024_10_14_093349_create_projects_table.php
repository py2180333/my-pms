<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('customer_id'); // Foreign key for customer
            $table->unsignedBigInteger('vendor_id')->nullable(); // Foreign key for vendor, optional
            $table->unsignedBigInteger('project_manager_id'); // Foreign key for project manager
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['planning', 'in_progress', 'completed', 'hold'])->default('planning');
            $table->decimal('project_value', 15, 2)->nullable(); // Store monetary value
            $table->json('documents')->nullable(); // Store file paths in JSON format
            $table->text('notes')->nullable();
            $table->string('uniquename');
            $table->softDeletes(); // Add soft delete column
            $table->timestamps();

            // Define foreign key relationships
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('set null');
            $table->foreign('project_manager_id')->references('id')->on('resources')->onDelete('cascade'); // Assuming resources table handles project managers
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
