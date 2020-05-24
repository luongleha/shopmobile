<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity_buy');
            $table->integer('total_money');
            $table->integer('money_taken')->nullable();
            $table->integer('excess_cash')->nullable();
            $table->integer('userinfo_id');
            $table->integer('user_id');
            $table->date('date');
            $table->integer('checked')->default(0);
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
        Schema::dropIfExists('bills');
    }
}
