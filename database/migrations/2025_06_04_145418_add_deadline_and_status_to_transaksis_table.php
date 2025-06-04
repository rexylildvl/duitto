<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->date('deadline')->nullable();
            $table->enum('status', ['belum', 'sudah'])->default('belum');
        });
    }
    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn(['deadline', 'status']);
        });
    }
};
