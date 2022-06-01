<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home')->constrained('clubs')->onDelete('cascade');
            $table->foreignId('away')->constrained('clubs')->onDelete('cascade');
            $table->foreignId('stadion_id')->constrained('stadions')->onDelete('cascade');
            $table->foreignId('judge_id')->constrained('judges')->onDelete('cascade');
            $table->integer('score_home')->default(0);
            $table->integer('score_away')->default(0);
            $table->integer('yellow_card_home')->default(0);
            $table->integer('yellow_card_away')->default(0);
            $table->integer('red_card_home')->default(0);
            $table->integer('red_card_away')->default(0);
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
        Schema::dropIfExists('games');
    }
}
