<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('role')->nullable();;
            $table->date('tgl_lahir')->nullable();;
            $table->string('tempat_lahir')->nullable();;
            $table->string('alamat')->nullable();;
            $table->string('jk')->nullable();;
            $table->string('agama')->nullable();;
            $table->string('no_ktp')->nullable();;
            $table->string('no_telp')->nullable();;
            $table->string('foto')->nullable();;
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
