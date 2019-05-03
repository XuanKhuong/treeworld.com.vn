<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('detail_product_id')->unsigned();
            $table->bigInteger('quantity')->unsigned();
            $table->float('price', 8, 2)->unsigned();
            $table->float('sale_price', 8, 2)->unsigned();
            $table->String('unit')->nullable();//đơn vị tính
            $table->float('total', 8, 2)->unsigned();//tổng tiền
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
        Schema::dropIfExists('detail_orders');
    }
}
