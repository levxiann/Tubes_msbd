<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_users', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_transaksi', ['Insert', 'Update', 'Delete']);
            $table->unsignedBigInteger('user_id');
            $table->string('new_name')->nullable();
            $table->string('old_name')->nullable();
            $table->string('new_username')->nullable();
            $table->string('old_username')->nullable();
            $table->string('new_email')->nullable();
            $table->string('old_email')->nullable();
            $table->date('new_tanggal_lahir')->nullable();
            $table->date('old_tanggal_lahir')->nullable();
            $table->string('new_alamat')->nullable();
            $table->string('old_alamat')->nullable();
            $table->string('new_no_hp')->nullable();
            $table->string('old_no_hp')->nullable();
            $table->string('new_role')->nullable();
            $table->string('old_role')->nullable();
            $table->string('new_section_id')->nullable();
            $table->string('old_section_id')->nullable();
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
        Schema::dropIfExists('log_users');
    }
}
