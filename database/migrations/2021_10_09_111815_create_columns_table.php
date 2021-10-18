<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type');
            $table->string('slug');
            $table->integer('column_degree');
            $table->string('description');
            $table->bigInteger('parent_id_avg')->unsigned()->nullable();
            $table->bigInteger('parent_id_sum')->unsigned()->nullable();
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->integer('student_degree');
            $table->foreign('parent_id_avg')->references('id')->on('columns');
            $table->foreign('parent_id_sum')->references('id')->on('columns');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
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
        Schema::dropIfExists('lists');
    }
}
