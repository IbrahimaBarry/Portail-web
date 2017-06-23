<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSousGroupesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sous_groupes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('groupe_id')->unsigned();
            $table->foreign('groupe_id')->references('id')->on('groupes')->onUpdate('cascade')->onDelete('cascade');
            $table->text('themes');
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
        Schema::dropIfExists('sous_groupes');
    }
}
