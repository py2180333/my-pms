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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('option_tax', 10)->nullable();
            $table->string('defult_currency', 10)->nullable();
            $table->string('defult_currency_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('option_tax');
            $table->dropColumn('defult_currency');
            $table->dropColumn('defult_currency_value');
        });
    }
};
