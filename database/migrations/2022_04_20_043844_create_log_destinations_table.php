<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_destinations', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_transaksi', ['Insert', 'Update', 'Delete']);
            $table->string('no_disposisi', 50);
            $table->unsignedBigInteger('new_ditujukan')->nullable();
            $table->unsignedBigInteger('old_ditujukan')->nullable();
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
        Schema::dropIfExists('log_destinations');
    }
}
