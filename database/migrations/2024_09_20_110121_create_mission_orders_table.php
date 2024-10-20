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
        Schema::create('mission_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->date('order_date');
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('purpose');
            $table->text('description')->nullable();
            $table->string('arrive_location');
            $table->string('departure_location');
            $table->foreignId('bareme_id')->constrained()->onDelete('cascade');
            $table->integer('no_meals')->default(0);
            $table->integer('no_accomodation')->default(0);
            $table->integer('no_ded_meals')->default(0);
            $table->integer('no_ded_accomodation')->default(0);
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->boolean('charge');
            $table->boolean('ijm');
            $table->boolean('assurance');
            $table->string('budget_text')->default('Imputation budgétaire : 625-12 et 625-62');
            $table->decimal('total_amount', 8, 2)->default(0);
            $table->string('currency')->nullable();
            $table->enum('status', ['draft', 'sup_approve', 'hr_approve', 'sg_approve', 'rejected', 'approved', 'paid'])->default('draft');
            $table->enum('memor_status',['draft', 'sup_approve', 'hr_approve', 'sg_approve', 'rejected', 'approved', 'paid'])->nullable();
            $table->decimal('advance', 8, 2)->default(0);
            $table->date('memor_date')->default(now());
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_orders');
    }
};
