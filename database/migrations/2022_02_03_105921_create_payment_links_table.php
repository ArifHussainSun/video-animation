<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_links', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->index()->nullable();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('token')->nullable()->unique();
            $table->bigInteger('valid_till')->unsigned();
            $table->string('item_name')->nullable();
            $table->float('price')->nullable();
            $table->string('discount_type')->nullable();
            $table->float('discount')->nullable();
            $table->float('original_price')->nullable();
            $table->longText('item_description')->nullable();
            $table->string('currency')->nullable();
            $table->string('category_id')->nullable();
            $table->bigInteger('coupon_id')->unsigned()->index()->nullable();
            $table->bigInteger('sale_type_id')->unsigned()->index()->nullable();
            $table->foreign('sale_type_id')->references('id')->on('payment_sale_type')->onDelete('cascade')->onUpdate('cascade');
            $table->string('payment_gateway');
            $table->string('payment_type');
            $table->string('payment_cycle')->nullable();
            $table->float('remaining_amount')->nullable();
            $table->float('balance')->nullable();
            $table->longText('comment')->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('updated_by')->unsigned()->index()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('status')->default(1);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_links');
    }
}
