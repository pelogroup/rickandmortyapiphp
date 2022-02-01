<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // Auto-increment is disable. So id must to be filled within the model Location ($fillable)
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            //$table->unsignedBigInteger('character_origin_id')->default(0);
            $table->unsignedBigInteger('character_id')->default(0);
            $table->string('type')->nullable();
            $table->string('dimension')->default('Unknown');
            $table->string('url')->nullable();
            $table->string('created')->nullable();
            $table->timestamps();
        });

        Schema::table('locations', function (Blueprint $table) {
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
        Schema::table('locations', function(Blueprint $table)
        {
            //$table->dropForeign('locations_user_id_foreign');
            $table->dropForeign(['user_id']);
            //$table->dropIndex('locations_user_id_index');
            //$table->dropColumn('user_id');
            $table->dropColumn([
                'user_id',
            ]);
        });
        Schema::dropIfExists('locations');
    }
}
