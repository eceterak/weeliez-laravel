<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('motorcycle_id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('type_id');
            $table->string('value');
            $table->timestamps();

            $table->foreign('motorcycle_id')->references('id')->on('motorcycles')->onDelete('cascade');
            //$table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            //$table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specs');
    }
}
