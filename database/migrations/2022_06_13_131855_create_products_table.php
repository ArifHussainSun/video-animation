<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->float('price');
            $table->float('sales_price');
            $table->float('regular_price');
            $table->longText('description')->nullable();
            $table->string('currency')->nullable();
            $table->string('image')->nullable();
            $table->longText('metatitle')->nullable();
            $table->longText('metakeyword')->nullable();
            $table->longText('desc')->nullable();
            $table->bigInteger('categories_id')->unsigned()->index()->nullable();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('sub_categories_id')->unsigned()->index()->nullable();
            $table->foreign('sub_categories_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('updated_by')->unsigned()->index()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
