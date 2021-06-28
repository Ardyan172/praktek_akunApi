<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // nama, jumlah, time, tipe
            $table->string('nama');
            $table->double('jumlah');
            // tipe data double karena jumlah angka bisa mengandung koma
            $table->enum('type', ['pemasukan', 'pengeluaran']);
            // hanya boleh menginput pemasukan atau pengeluaran
            $table->timestamp('waktu')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
