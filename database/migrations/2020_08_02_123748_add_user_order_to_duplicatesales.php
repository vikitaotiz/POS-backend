<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserOrderToDuplicatesales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('duplicatesales', function (Blueprint $table) {
            $table->string('user_order');
            $table->integer('amount_paid')->nullable();
            $table->integer('balance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('duplicatesales', function (Blueprint $table) {
            $table->string('user_order');
            $table->integer('amount_paid')->nullable();
            $table->integer('balance')->nullable();
        });
    }
}
