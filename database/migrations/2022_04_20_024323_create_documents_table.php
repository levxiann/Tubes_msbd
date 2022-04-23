<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->string('no', 50);
            $table->primary('no');
            $table->string('nama_dokumen');
            $table->unsignedBigInteger('document_type_id');
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('restrict')->onUpdate('restrict');
            $table->enum('sifat_dokumen', ['umum', 'rahasia']);
            $table->date('tanggal_terbit');
            $table->string('perihal');
            $table->string('file_dokumen');
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
        Schema::dropIfExists('documents');
    }
}
