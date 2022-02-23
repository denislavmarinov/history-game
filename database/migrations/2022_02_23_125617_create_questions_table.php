<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text("question");
            $table->json("answers");
            $table->integer("points")->default(10);
            $table->unsignedBigInteger("difficulty");
            $table->unsignedBigInteger("added_by");
            $table->datetime("added_at");
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->datetime("updated_at")->nullable();
            $table->unsignedBigInteger("deleted_by")->nullable();
            $table->datetime("deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
