<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentXmlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_xmls', function (Blueprint $table) {
            $table->id();
            $table->integer('id_flat');
            $table->double('bet', 10, 5);
            $table->string('name_agent');
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
        Schema::dropIfExists('current_xmls');
    }
}
