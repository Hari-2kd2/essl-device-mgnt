<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_copies', function (Blueprint $table) {
            $table->id();
            $table->string('sdwEnrollNumber');
            $table->string('sName');
            $table->integer('idwFingerIndex');
            $table->integer('iPrivilege');
            $table->string('sPassword');
            $table->string('sTmpData');
            $table->string('sEnabled');
            $table->string('sLastEnrollNumber');
            $table->integer('iFlag');
            $table->integer('iTmpLength');
            $table->string('fromip');
            $table->string('toips');
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
        Schema::dropIfExists('user_copies');
    }
}
