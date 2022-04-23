<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogInmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_inmails', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_transaksi', ['Insert', 'Update', 'Delete']);
            $table->string('no_surat', 50);
            $table->unsignedBigInteger('new_jenis_surat')->nullable();
            $table->unsignedBigInteger('old_jenis_surat')->nullable();
            $table->unsignedBigInteger('new_bagian')->nullable();
            $table->unsignedBigInteger('old_bagian')->nullable();
            $table->date('new_tanggal_masuk')->nullable();
            $table->date('old_tanggal_masuk')->nullable();
            $table->string('new_perihal')->nullable();
            $table->string('old_perihal')->nullable();
            $table->char('new_disposisi')->nullable();
            $table->char('old_disposisi')->nullable();
            $table->string('new_pokok_masalah')->nullable();
            $table->string('old_pokok_masalah')->nullable();
            $table->string('new_status')->nullable();
            $table->string('old_status')->nullable();
            $table->string('new_file_surat')->nullable();
            $table->string('old_file_surat')->nullable();
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
        Schema::dropIfExists('log_inmails');
    }
}
