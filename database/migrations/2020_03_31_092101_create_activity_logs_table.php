<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 100);
            $table->text('description');
            $table->string('model', 100);
            $table->bigInteger('model_id');
            $table->bigInteger('users_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
        });

        Schema::dropIfExists('activity_logs');
    }
}
