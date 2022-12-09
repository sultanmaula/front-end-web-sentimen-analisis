<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmoteKnnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smote_knn', function (Blueprint $table) {
            $table->id();
            $table->text('precision');
            $table->text('recall');
            $table->text('f1-score');
            $table->text('support');
            $table->text('accuracy');
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
        Schema::dropIfExists('smote_knn');
    }
}
