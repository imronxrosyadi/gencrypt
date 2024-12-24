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
        Schema::create('report_data', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->unique();
            $table->string('extension');
            // $table->text('data');
            // $table->binary('data_binary');
            $table->string('key');
            $table->string('path');
            $table->timestamp('encryption_time')->nullable();
            $table->timestamp('decryption_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_data');
    }
};
