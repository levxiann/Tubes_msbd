<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositions', function (Blueprint $table) {
            $table->string('no', 50);
            $table->primary('no');
            $table->string('inmail_no', 50);
            $table->foreign('inmail_no')->references('no')->on('inmails')->onDelete('cascade')->onUpdate('cascade');
            $table->date("tanggal_disposisi");
            $table->string('isi_disposisi');
            $table->enum('status', ['unread', 'read']);
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
        Schema::dropIfExists('dispositions');
    }
}
