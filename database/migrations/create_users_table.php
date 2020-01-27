<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class createUsersTable extends Migration {

    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_verified');
            $table->enum('status', ['active', 'inactive', 'block']);

            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }
}
