<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->longText('content');
            $table->integer('amount');
            $table->string('table_name');
            $table->boolean('sold')->default(0);
            $table->boolean('freaze')->default(0);
            $table->string('user_order');
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
        Schema::dropIfExists('readies');
    }
}
