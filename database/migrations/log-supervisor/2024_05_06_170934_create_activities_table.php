<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('action')->nullable();
            $table->longText('description')->nullable();
            $table->string('role')->nullable();
            $table->string('group')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('route')->nullable();
            $table->string('referrer')->nullable();
            $table->string('method')->nullable();
            $table->string('locale')->nullable();
            // $table->json('params')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            // $table->string('platform')->nullable();
            // $table->string('device')->nullable();
            $table->string('ip_address', 64)->nullable();
            $table->json('attributes')->nullable();




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
        Schema::dropIfExists('activities');
    }
}
