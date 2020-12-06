<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadioListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radio_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->integer('genres_id')->default(0);
            $table->integer('language_id')->default(0);
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('streaming_link')->nullable();
            $table->integer('count')->default(0);
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('radio_lists');
    }
}
