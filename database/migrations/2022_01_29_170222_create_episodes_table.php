<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // Auto-increment is disable. So id must to be filled within the model Episode ($fillable)
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('character_id')->default(0);
            $table->string('air_date')->default('');
            $table->string('episode')->default('');
            //$table->unsignedBigInteger('character_origin_id')->default(0);
            $table->string('url')->nullable();
            $table->string('created')->nullable();
            $table->timestamps();
        });
        Schema::table('episodes', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('episodes', function(Blueprint $table)
        {
            //$table->dropForeign('episodes_user_id_foreign');
            $table->dropForeign(['user_id']);
            //$table->dropIndex('episodes_user_id_index');
            //$table->dropColumn('user_id');
            $table->dropColumn([
                'user_id',
            ]);
        });
        Schema::dropIfExists('episodes');
    }
}
