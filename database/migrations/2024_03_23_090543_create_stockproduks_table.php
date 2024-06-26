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
        Schema::create('stockproduk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->references('id')->on('produk')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('in')->default(0);
            $table->integer('out')->default(0);
            $table->integer('saldo')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockproduk');
    }
};
