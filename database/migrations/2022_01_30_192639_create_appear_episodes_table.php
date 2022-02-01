<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppearEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appear_episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('character_id')->index();
            $table->unsignedBigInteger('episode_id')->index();
            $table->timestamps();
        });
        Schema::table('appear_episodes', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('appear_episodes', function (Blueprint $table) {
            $table->foreign('character_id')
                ->references('id')
                ->on('characters')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('appear_episodes', function (Blueprint $table) {
            $table->foreign('episode_id')
                ->references('id')
                ->on('episodes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appear_episodes', function(Blueprint $table)
        {
            //$table->dropForeign('locations_user_id_foreign');
            $table->dropForeign(['user_id', 'character_id', 'episode_id']);
            //$table->dropForeign(['character_id']);
            //$table->dropForeign(['episode_id']);
            //$table->dropIndex(['locations_user_id_index']);
            //$table->dropColumn('user_id');
            $table->dropColumn(['user_id', 'character_id', 'episode_id']);
        });
        Schema::dropIfExists('appear_episodes');
    }
}
