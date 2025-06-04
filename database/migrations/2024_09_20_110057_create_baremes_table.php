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
        Schema::create('baremes', function (Blueprint $table) {
            $table->id();
            $table->string('pays');
            $table->string('currency');
            $table->decimal('pays_per_day', 8, 2);
            $table->decimal('meal_cost', 8, 2);
            $table->decimal('accomodation_cost', 8, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baremes');
    }
};
