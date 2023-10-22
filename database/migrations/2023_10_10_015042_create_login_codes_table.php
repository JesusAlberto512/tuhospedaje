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
        Schema::create('login_codes', function (Blueprint $table) {
            $table->id('code_id');
            $table->integer('verification_code');
            $table->integer('expiration_time')->default('5');
            $table->string('phone');
            $table->integer('carrier_code');
            $table->integer('verified')->default('0');
            $table->timestamp('verified_date')->default(null);
            $table->timestamps();

            /*** index keys ***/
            $table->index(['code_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_codes');
    }
};
