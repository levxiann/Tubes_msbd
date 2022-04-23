<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogDispositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_dispositions', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_transaksi', ['Insert', 'Update', 'Delete']);
            $table->string('no_disposisi', 50);
            $table->string('no_surat', 50);
            $table->date("new_tanggal_disposisi")->nullable();
            $table->date("old_tanggal_disposisi")->nullable();
            $table->string('new_isi_disposisi')->nullable();
            $table->string('old_isi_disposisi')->nullable();
            $table->string('new_status')->nullable();
            $table->string('old_status')->nullable();
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
        Schema::dropIfExists('log_dispositions');
    }
}
