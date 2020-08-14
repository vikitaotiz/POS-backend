<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpensecatIdToExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->integer('expensecat_id');
            $table->integer('measurementunit_id');
            $table->integer('paymentmode_id');
            $table->integer('provider_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->integer('expensecat_id');
            $table->integer('measurementunit_id');
            $table->integer('paymentmode_id');
            $table->integer('provider_id');
        });
    }
}
