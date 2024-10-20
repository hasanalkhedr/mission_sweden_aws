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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->foreignId('department_id')->constrained('departments')->cascadeOnUpdate()->nullOnDeleteonDelete();
            $table->string('profile_image')->nullable();
            $table->boolean('is_supervisor')->default(false);
            $table->boolean('recieve_email')->default(false);
            $table->boolean('allow_order')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('role', ['employee', 'supervisor', 'hr', 'sg']);
            $table->string('position')->nullable();
            $table->string('administrativ_residence')->nullable();
            $table->string('service')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
