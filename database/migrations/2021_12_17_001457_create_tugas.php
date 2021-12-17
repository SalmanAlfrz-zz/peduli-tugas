<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tugas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('nama');
            $table->dateTime('deadline');
            $table->char('jenis', 50);
            $table->float('bobot');
            $table->char('status', 50);
            $table->foreignId('user_id');
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
        Schema::dropIfExists('t_tugas');
    }
}
