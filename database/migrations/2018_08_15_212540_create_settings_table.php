<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('admition_type', ['all', 'whitelist']);
            $table->boolean('user_enc');
            $table->boolean('auth_cu');
            $table->boolean('auth_email');
            $table->boolean('auth_rut');
            $table->boolean('auto_start');
            $table->boolean('auto_end');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('votation_id')->reference('id')->on('votations');
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
        Schema::dropIfExists('settings');
    }
}
