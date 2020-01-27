<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class createPostsTable extends Migration {

    public function up()
    {
        Schema::table('posts', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->mediumText('text');
            $table->enum('status', ['active', 'draft', 'pending']);
            $table->dateTimeTz('published_at');
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->foreign('user_id', 'posts_user_id_fk')
                ->references('id')->on('users')->onDelete('cascade');
        });
    }
}
