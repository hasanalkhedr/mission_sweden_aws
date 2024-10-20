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
        Schema::create('tournee_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournee_id')->constrained('tournees')->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->string('currency');
            $table->text('description');
            $table->date('expense_date');
            $table->string('expense_document');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournee_expenses');
    }
};
