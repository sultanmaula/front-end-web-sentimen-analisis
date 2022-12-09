<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAfterPreprocessingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preprocessing', function (Blueprint $table) {
            $table->id();
            $table->text('username');
            $table->text('content');
            $table->text('review_tokens');
            $table->text('review_tokens_fdist');
            $table->text('review_tokens_WSW');
            $table->text('review_normalized');
            $table->text('review_tokens_stemmed');
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
        Schema::dropIfExists('preprocessing');
    }
}
