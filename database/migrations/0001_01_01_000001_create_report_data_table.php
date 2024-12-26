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
            $table->string('filename');
            $table->string('filename_encrypt')->unique();
            $table->string('extension');
            $table->float('original_size');
            $table->float('encrypt_size');
            // $table->text('data');
            // $table->binary('data_binary');
            $table->string('key');
            $table->string('path_encrypt')->nullable();
            $table->string('path_decrypt')->nullable();
            $table->string('encryption_time')->nullable();
            $table->string('decryption_time')->nullable();
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
