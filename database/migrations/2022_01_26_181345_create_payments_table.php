<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->index()->nullable();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('token')->nullable()->unique();
            $table->bigInteger('valid_till')->unsigned()->nullable();
            $table->string('item_name')->nullable();
            $table->float('price')->nullable();
            $table->string('discount_type')->nullable();
            $table->float('discount')->nullable();
            $table->float('original_price')->nullable();
            $table->string('item_description')->nullable();
            $table->string('converted_amount')->nullable();
            $table->string('currency')->nullable();
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('coupon_id')->unsigned()->index()->nullable();
            $table->bigInteger('sale_type_id')->unsigned()->index()->nullable();
            $table->foreign('sale_type_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('payment_gateway');
            $table->string('payment_type');
            $table->string('payment_cycle')->nullable();
            $table->float('remaining_amount')->nullable();
            $table->float('balance')->nullable();
            $table->longText('comment')->nullable();
            $table->date('payment_on')->nullable();
            $table->longText('message')->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('updated_by')->unsigned()->index()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('payments');
    }
}
