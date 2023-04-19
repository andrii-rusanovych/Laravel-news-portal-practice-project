<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            /**
             * image_file_path - is a path in 'public' disc
             *
             * Chose VARCHAR(50) for file_path based on the following considerations:
             * "images/": 7 characters
             * UUID without dashes: 32 characters
             * File extension: 4 characters (could be slightly longer)
             * Total length: 7 + 32 + 4 = 43 characters
             * Added buffer for longer file extensions
             **/
            $table->string('image_file_path', 50);
            $table->mediumText("body");
            $table->boolean("isActive")->default(false);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('news');
    }
}
