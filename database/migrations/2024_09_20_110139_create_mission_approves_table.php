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
        Schema::create('mission_approves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_order_id')->constrained('mission_orders')->onDelete('cascade');
            $table->foreignId('approval_id')->constrained('employees')->onDelete('cascade');
            $table->string('approval_role');
            $table->text('comment')->nullable();
            $table->enum('status', ['draft', 'sup_approve', 'hr_approve', 'sg_approve', 'rejected', 'approved', 'paid'])->nullable();
            $table->enum('memor_status', ['draft', 'sup_approve', 'hr_approve', 'sg_approve', 'rejected', 'approved', 'paid'])->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_approves');
    }
};
