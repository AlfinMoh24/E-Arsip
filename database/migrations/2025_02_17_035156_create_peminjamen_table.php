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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()->onDelete('cascade');
            $table->string('no_dok');
            $table->string('nama_dok');
            $table->string('tgl_ambil');
            $table->string('tgl_kembali');
            $table->string('tgl_pengembalian')->default('-');
            $table->enum('approval', ['pending', 'approved', 'denied'])->default('pending');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
