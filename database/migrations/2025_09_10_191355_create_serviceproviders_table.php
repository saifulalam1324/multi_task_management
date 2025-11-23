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
    Schema::create('serviceproviders', function (Blueprint $table) {
        $table->id('sp_id');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('password');
        $table->string('service_type');
        $table->string('address');
        $table->boolean('approve_status')->default(false);
        $table->string('image_url');
        $table->string('status')->default('active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serviceproviders');
    }
};
