<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgToSkus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skus', function (Blueprint $table) {
            $table->text('img');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skus', function (Blueprint $table) {
            $table->dropColumn('img');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('img');
        });
    }
}
