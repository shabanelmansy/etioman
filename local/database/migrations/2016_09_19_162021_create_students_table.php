<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')
                  ->references('id')->on('courses')
                  ->onDelete('cascade');


            $table->integer('user_id');
            
            $table->integer('student_id');
            $table->string('name_en')->nullable();
            $table->string('name_ar');
            $table->integer('certificate_no');
            $table->string('mobile')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('organaization')->nullable();
            $table->integer('fee')->nullable();
            $table->string('level')->nullable();
            $table->string('mark')->nullable();


            $table->string('cips_member_id')->nullable();
            $table->string('cips_valed_to')->nullable();
            $table->string('cips_password')->nullable();
            $table->date('cips_u1_exam_date')->nullable();
            $table->string('cips_u1_exam_result')->nullable();
            $table->date('cips_u2_exam_date')->nullable();
            $table->string('cips_u2_exam_result')->nullable();
            $table->date('cips_u3_exam_date')->nullable();
            $table->string('cips_u3_exam_result')->nullable();
            $table->date('cips_u4_exam_date')->nullable();
            $table->string('cips_u4_exam_result')->nullable();
            $table->date('cips_u5_exam_date')->nullable();
            $table->string('cips_u5_exam_result')->nullable();
            $table->text('cips_comments')->nullable();

           
            $table->date('cm_m1_exam_date')->nullable();
            $table->string('cm_m1_exam_result')->nullable();
            $table->date('cm_m2_exam_date')->nullable();
            $table->string('cm_m2_exam_result')->nullable();
            $table->date('cm_m3_exam_date')->nullable();
            $table->string('cm_m3_exam_result')->nullable();
            $table->text('cm_comments')->nullable();


            $table->date('gafm_exam_date')->nullable();
            $table->string('gafm_result')->nullable();
            $table->text('gafm_comments')->nullable();

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
        Schema::drop('students');
    }
}
