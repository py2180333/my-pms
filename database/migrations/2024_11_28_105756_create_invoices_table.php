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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_p_no')->nullable();
            $table->date('invoice_date');
            $table->date('invoice_due_date')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('milestone_id')->nullable();
            $table->text('note')->nullable();
            $table->decimal('alltotal', 10, 2);
            $table->decimal('gst', 5, 2)->nullable();
            $table->decimal('grandtotal', 10, 2);
            $table->string('currency', 10);
            $table->string('prefix');
            $table->enum('status', ['pending', 'paid', 'overdue'])->default('pending');
            $table->unsignedBigInteger('template');
            $table->string('invoice_number')->unique();
            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->integer('sr_no');
            $table->text('description');
            $table->decimal('rate', 10, 2);
            $table->integer('quantity');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
    }
};
