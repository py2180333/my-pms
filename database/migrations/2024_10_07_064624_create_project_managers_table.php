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
        Schema::create('project_managers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->json('skills'); // Assuming skills are stored as JSON
            $table->enum('payment_type', ['hourly', 'monthly']);
            $table->decimal('rate', 10, 2);
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('national_id');
            $table->string('pan_number');
            $table->string('address');
            $table->string('username')->unique();
            $table->string('profile_picture')->nullable();
            $table->string('password');
            $table->enum('status',['active','inactive'])->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_managers');
    }
};
