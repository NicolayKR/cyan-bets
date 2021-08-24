<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTariph extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('paid_month')->after('email')->default(0);
            $table->string('paid_tariph')->after('paid_month')->default(0);
            $table->string('left_day')->after('paid_tariph')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('paid_month');
            $table->dropColumn('paid_tariph');
            $table->dropColumn('left_day');
        });
    }
}
