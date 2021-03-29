<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdivsorInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adivsor_infos', function (Blueprint $table) {
            $table->id();
            $table->String('advisorname');
            $table->String('email');
            $table->String('phone');
            $table->String('skill');
            $table->String('advise');
            $table->String('mcacc');
            $table->String('tech');
            $table->String('userid');
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
        Schema::dropIfExists('adivsor_infos');
    }
}
