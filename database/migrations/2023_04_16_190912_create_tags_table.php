<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\NewsSeeder;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag',255);
            $table->unsignedBigInteger('news_id');

            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            $seeder = app()->make(NewsSeeder::class);
            $seeder->down();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign(['news_id']);
        });


        Schema::dropIfExists('tags');
    }
}
