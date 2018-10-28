<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')
                ->charset('utf8')
                ->comment('Path to the Resourse')
                ->nullable(false);
            $table->integer('status')
                ->default(0)
                ->nullable(false)
                ->comment('Download status');
            $table->string('local_path')
                ->nullable()
                ->comment('Generated path to file');
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
        Schema::dropIfExists('downloads');
    }
}
