<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKimiaFarmaTable extends Migration
{
    public function up()
    {
        Schema::create('kimia_farma', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat');
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kimia_farma');
    }
}
