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
        Schema::create('leave_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('leave_type', ['paid', 'unpaid']);
            $table->enum('leave_duration', ['fullday', 'halfday']);
            $table->decimal('totalday',5,2)->nullable();
            $table->timestamps();

            $table->foreign('leave_id')->references('id')->on('leaves')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_details');
    }
};
