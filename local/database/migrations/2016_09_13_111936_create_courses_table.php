<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('venue');
            $table->string('instructor');
            $table->date('start_at');
            $table->date('end_at');
            $table->enum('lanquage', ['en', 'ar']);
            $table->enum('certificate', ['institute', 'ministry']);
            $table->integer('duration')->nullable();
            $table->enum('organization', ['individual', 'group']);
            $table->string('org_name')->nullable();
            $table->double('fees',5,2)->nullable();
            $table->enum('awarding_body', ['local', 'cips','cm', 'gafm']);
            $table->integer('user_id');
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
        //
        Schema::drop('courses');
    }
}
