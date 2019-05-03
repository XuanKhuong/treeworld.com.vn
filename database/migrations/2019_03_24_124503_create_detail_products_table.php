<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name')->nullable();
            $table->bigInteger('quantity')->unsigned();
            $table->bigInteger('color_id')->unsigned(); 
            $table->float('price', 8, 2)->unsigned();
            $table->String('life_expectancy')->nullable();//tuổi thọ
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('status')->nullable();
            $table->string('slug')->unique(); 
            $table->float('sale_price', 8, 2)->unsigned();
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
        Schema::dropIfExists('detail_products');
    }
}
