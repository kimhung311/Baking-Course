<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_details', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->unsignedInteger('course_detail_type_id');     
            $table->text('description')->nullable();
            $table->integer('difficulty')->nullable();
            $table->string('icon');
            $table->tinyInteger('is_updated')->nullable();
            $table->integer('price');
            $table->integer('lesson_count')->nullable();
            $table->integer('total_user');
            $table->integer('rest_user')->nullable();
            $table->datetime('timestamp')->nullable();
            $table->string('duration')->nullable();
            $table->string('place')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('course_details');
    }
}
