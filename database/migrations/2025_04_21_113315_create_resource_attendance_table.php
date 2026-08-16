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
        Schema::create('resource_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resource_id');
            $table->date('date');
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
            $table->integer('break_minutes')->default(0); // total break time in minutes
            $table->string('status')->nullable(); // Present, Absent, Late, etc.
            //$table->timestamp('current_break_start')->nullable()->after('break_minutes');
            $table->timestamps();

            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_attendance');
    }
};
