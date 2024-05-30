<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefs', function (Blueprint $table) {
            $table->id();
            $table->string('cus_name')->nullable();
            $table->string('cus_email')->nullable();
            $table->integer('cus_phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_slogan')->nullable();
            $table->longText('industry')->nullable();
            $table->longText('logo_color')->nullable();
            $table->string('logo_style')->nullable();
            $table->longText('logo_type')->nullable();
            $table->longText('data')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('briefs');
    }
};
