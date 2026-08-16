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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_picture')->nullable();
            $table->text('description')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('national_id')->nullable();
            $table->string('address')->nullable();
            $table->string('company_name');
            $table->string('company_phone_number');
            $table->string('company_email')->unique();
            $table->string('pan_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('password');
            $table->enum('status', ['active', 'deactive'])->default('active'); // Status field
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
