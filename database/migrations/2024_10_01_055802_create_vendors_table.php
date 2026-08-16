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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_picture')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('national_id');
            $table->string('address');
            $table->string('pan_number')->nullable();
            $table->string('company_name');
            $table->string('bank_account_no');
            $table->string('account_holder_name');
            $table->string('branch_name');
            $table->string('bank_name');
            $table->string('Tax_number')->nullable();
            $table->enum('code_type',['both','IFSC','Swift']);
            $table->string('ifsc_code')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('vendors');
    }
};
