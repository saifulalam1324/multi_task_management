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
        Schema::create('servicerequests', function (Blueprint $table) {
            $table->id("request_id");
            $table->foreignId('c_id')
                ->constrained('customers', 'c_id')
                ->onDelete('cascade');
            $table->foreignId('service_id')
                ->constrained('services', 'service_id')
                ->onDelete('cascade');
            $table->string('sp_id')->nullable();
            $table->string('status')->default('pending');
            $table->dateTime('work_started_at')->nullable();
            $table->dateTime('work_completed_at')->nullable();
            $table->decimal('total_hours_worked', 8, 2)->nullable();
            $table->decimal('total_payment', 10, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->decimal('payment_sp', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicerequests');
    }
};
