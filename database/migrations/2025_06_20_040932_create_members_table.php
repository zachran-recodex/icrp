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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('nickname')->nullable();
            $table->date('birth_date');
            $table->date('death_date')->nullable();
            $table->string('birth_place');
            $table->string('known_as');
            $table->string('position');
            $table->enum('dewan_category', ['direktur eksekutif', 'pengurus', 'kehormatan', 'pembina', 'pengawas', 'pengurus harian']);
            $table->text('quote')->nullable();
            $table->text('biography');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
