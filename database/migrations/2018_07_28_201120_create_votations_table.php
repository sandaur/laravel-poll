<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subdom', 18)->unique();
            $table->string('title', 40);
            $table->text('description', 450);
            $table->enum('status', ['open', 'closed', 'waiting'])->default('waiting');
            $table->integer('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('votations');
    }
}
