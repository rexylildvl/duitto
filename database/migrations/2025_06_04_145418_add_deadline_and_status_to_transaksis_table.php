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
        // Tambah kolom baru jika belum ada
        Schema::table('transaksis', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksis', 'nama')) {
                $table->string('nama')->nullable()->after('id');
            }
            if (!Schema::hasColumn('transaksis', 'frekuensi')) {
                $table->enum('frekuensi', ['hari', 'minggu', 'bulan'])->nullable()->after('nama');
            }
            if (!Schema::hasColumn('transaksis', 'target')) {
                $table->decimal('target', 12, 2)->nullable()->after('frekuensi');
            }
            if (!Schema::hasColumn('transaksis', 'deadline')) {
                $table->date('deadline')->nullable()->after('jumlah');
            }
            if (!Schema::hasColumn('transaksis', 'status')) {
                $table->enum('status', ['belum', 'sudah'])->default('belum')->after('deadline');
            }
        });

        // Ubah enum tipe agar bisa setor_tabungan
        \DB::statement("ALTER TABLE transaksis MODIFY tipe ENUM('pemasukan', 'pengeluaran', 'tagihan', 'tabungan', 'setor_tabungan') NOT NULL");
    }

    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (Schema::hasColumn('transaksis', 'nama')) {
                $table->dropColumn('nama');
            }
            if (Schema::hasColumn('transaksis', 'frekuensi')) {
                $table->dropColumn('frekuensi');
            }
            if (Schema::hasColumn('transaksis', 'target')) {
                $table->dropColumn('target');
            }
            if (Schema::hasColumn('transaksis', 'deadline')) {
                $table->dropColumn('deadline');
            }
            if (Schema::hasColumn('transaksis', 'status')) {
                $table->dropColumn('status');
            }
        });

        // Kembalikan enum tipe ke semula
        \DB::statement("ALTER TABLE transaksis MODIFY tipe ENUM('pemasukan', 'pengeluaran', 'tagihan', 'tabungan') NOT NULL");
    }
};
