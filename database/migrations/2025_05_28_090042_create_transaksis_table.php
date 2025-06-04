<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->enum('tipe', ['pemasukan', 'pengeluaran', 'tagihan', 'tabungan']);
        $table->decimal('jumlah', 12, 2);
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
