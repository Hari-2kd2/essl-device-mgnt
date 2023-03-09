<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsSqlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_sqls', function (Blueprint $table) {
            $table->id('primary_id');
            $table->integer('evtlguid')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('ID');
            $table->dateTime('datetime');
            $table->dateTime('punching_time')->nullable();
            $table->boolean('status')->default(false);
            $table->string('type')->nullable();
            $table->string('devuid')->nullable();
            $table->integer('devdt')->nullable();
            $table->string('device_name')->nullable();
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
        Schema::dropIfExists('ms_sqls');
    }
}
