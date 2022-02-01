<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // Auto-increment is disable. So id must to be filled within the model Character ($fillable)
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('status')->default('unknown');
            $table->string('species')->nullable();
            $table->string('type')->nullable();
            $table->string('gender')->default('unknown');
            //$table->text('gender')->default('unknown');
            $table->longText('image')->nullable();
            $table->longText('url')->nullable();
            $table->integer('origin')->default(0);
            $table->integer('location')->default(0);
            $table->string('created')->nullable();
            $table->timestamps();
        });
        Schema::table('characters', function (Blueprint $table) {
            //$table->unsignedBigInteger('user_id');
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
        Schema::table('characters', function(Blueprint $table)
        {
            //$table->dropForeign('characters_user_id_foreign');
            $table->dropForeign(['user_id']);
            //$table->dropIndex('characters_user_id_index');
            //$table->dropColumn('user_id');
            $table->dropColumn([
                'user_id',
            ]);
        });
        Schema::dropIfExists('characters');
    }
}
