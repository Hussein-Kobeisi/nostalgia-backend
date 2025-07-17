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
        Schema::create('capsules', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->date('create_date');
            $table->date('open_date');
            $table->boolean('privacy');
            $table->boolean('surprise');
            $table->timestamps();
        });

        Schema::create('capsule_media', function (Blueprint $table) {
            $table->id();
            $table->integer('capsule_id');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capsules');
        Schema::dropIfExists('capsule_media');
    }
};
