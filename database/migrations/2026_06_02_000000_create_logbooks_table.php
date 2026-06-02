<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->date('tanggal');
            $table->string('judul_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('lokasi')->nullable();
            $table->string('status')->default('pending');
            $table->text('catatan_pembimbing')->nullable();
            $table->string('bukti_kegiatan')->nullable();
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
        Schema::dropIfExists('logbooks');
    }
}
