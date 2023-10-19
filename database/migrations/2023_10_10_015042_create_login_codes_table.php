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
            $table->string('verification_code');
            $table->string('expiration_time');
            $table->integer('phone');
            $table->string('carrier_code');
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
