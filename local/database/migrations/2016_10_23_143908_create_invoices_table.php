<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // //
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('course_id');
            $table->integer('student_id')->default(0);
            $table->enum('type', ['credit', 'debit'])
                  ->default("credit");
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
         Schema::drop('invoices');
    }
}
