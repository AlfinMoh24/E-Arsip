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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('no_dok');
            $table->string('kode_dok');
            $table->string('nama_dok');
            $table->foreignId('ruang_id')->nullable()->constrained('raks')->nullOnDelete();
            $table->foreignId('rak_id')->nullable()->constrained('raks')->nullOnDelete();
            $table->foreignId('map_id')->nullable()->constrained('raks')->nullOnDelete();
            $table->foreignId('box_id')->nullable()->constrained('raks')->nullOnDelete();
            $table->foreignId('urut_id')->nullable()->constrained('raks')->nullOnDelete();
            $table->string('file');
            $table->string('ukuran');
            $table->string('deskripsi')->default('Tidak Ada Deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
