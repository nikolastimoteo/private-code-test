<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->string('email', 100);
            $table->string('password', 100);
            $table->bigInteger('users_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
        });

        Schema::dropIfExists('users');
    }
}
