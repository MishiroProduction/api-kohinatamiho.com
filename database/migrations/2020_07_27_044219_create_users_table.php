<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('id');
            $table->string('mail_address')->unique('UNQ_MAIL_ADDRESS')->comment('メールアドレス');
            $table->string('password')->comment('パスワード');
            $table->string('user_name')->comment('名前');
            $table->boolean('status')->unsigned()->default(1)->comment('ステータス');
            $table->boolean('role')->unsigned()->default(0)->comment('役職');
            $table->dateTimes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
