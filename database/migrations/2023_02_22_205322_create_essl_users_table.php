<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsslUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essl_users', function (Blueprint $table) {
            $table->id('essl_user_id');
            $table->string('sdwEnrollNumber')->nullable();
            $table->string('sName')->nullable();
            $table->integer('idwFingerIndex')->nullable();
            $table->integer('iPrivilege')->nullable();
            $table->string('sPassword')->nullable();
            $table->string('sTmpData')->nullable();
            $table->string('sEnabled')->nullable();
            $table->string('sLastEnrollNumber')->nullable();
            $table->integer('iFlag')->nullable();
            $table->integer('iTmpLength')->nullable();
            $table->string('fromip')->nullable();
            $table->string('toips')->nullable();
            $table->string('ip')->nullable();
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
        Schema::dropIfExists('essl_users');
    }
}
