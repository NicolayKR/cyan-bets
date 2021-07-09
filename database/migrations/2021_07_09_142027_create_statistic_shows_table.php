<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_shows', function (Blueprint $table) {
            $table->id();
            $table->integer('coverage');
            $table->integer('searches_count');
            $table->integer('shows_count');
            $table->integer('phone_shows');
            $table->integer('views');
            $table->integer('id_user');
            $table->integer('id_company');
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
        Schema::dropIfExists('statistic_shows');
    }
}
