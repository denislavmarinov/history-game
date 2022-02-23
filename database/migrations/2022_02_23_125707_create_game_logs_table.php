<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_logs', function (Blueprint $table) {
            $table->id();
            $table->json("questions");
            $table->integer("points");
            $table->boolean("status"); // false means loss, true means win
            $table->unsignedBigInteger("user");
            $table->time("game_completion_time");
            $table->datetime("started_at");
            $table->datetime("finished_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_logs');
    }
}
