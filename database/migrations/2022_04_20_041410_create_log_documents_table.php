<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_documents', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_transaksi', ['Insert', 'Update', 'Delete']);
            $table->string('no_dokumen', 50);
            $table->string('new_nama_dokumen')->nullable();
            $table->string('old_nama_dokumen')->nullable();
            $table->unsignedBigInteger('new_jenis_dokumen')->nullable();
            $table->unsignedBigInteger('old_jenis_dokumen')->nullable();
            $table->unsignedBigInteger('new_pemilik')->nullable();
            $table->unsignedBigInteger('old_pemilik')->nullable();
            $table->string('new_sifat_dokumen')->nullable();
            $table->string('old_sifat_dokumen')->nullable();
            $table->date('new_tanggal_terbit')->nullable();
            $table->date('old_tanggal_terbit')->nullable();
            $table->string('new_perihal')->nullable();
            $table->string('old_perihal')->nullable();
            $table->string('new_file_dokumen')->nullable();
            $table->string('old_file_dokumen')->nullable();
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
        Schema::dropIfExists('log_documents');
    }
}
