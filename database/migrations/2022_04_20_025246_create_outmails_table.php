<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outmails', function (Blueprint $table) {
            $table->string('no', 50);
            $table->primary('no');
            $table->unsignedBigInteger('mail_type_id');
            $table->foreign('mail_type_id')->references('id')->on('mail_types')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('restrict')->onUpdate('restrict');
            $table->date('tanggal_keluar');
            $table->string('perihal');
            $table->string('pokok_masalah');
            $table->enum('status', ['unread', 'read']);
            $table->string('file_surat');
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
        Schema::dropIfExists('outmails');
    }
}
