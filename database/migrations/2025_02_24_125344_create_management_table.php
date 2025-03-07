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
        Schema::create('management', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('slug')->unique();
            $table->date('birth_date');
            $table->date('death_date')->nullable();
            $table->string('birth_place');
            $table->string('known_as');
            $table->text('quote')->nullable();
            $table->text('biography');
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->string('position');
            $table->enum('dewan', ['Directure Excecutive', 'Pengurus', 'Kehormatan', 'Pembina', 'Pengawas', 'Pengurus Harian']);
            $table->timestamps();
        });

        // Membuat tabel untuk kontribusi pendiri
        Schema::create('management_contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('management_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Membuat tabel untuk warisan pemikiran pendiri
        Schema::create('management_legacies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('management_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('management_legacies');
        Schema::dropIfExists('management_contributions');
        Schema::dropIfExists('management');
    }
};
