<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('roll_number');
            $table->string('name');
            $table->string('school_code');  // Add this column
            $table->string('category_code');  // Add this column
            $table->json('subjects');  // Add this column if you plan to store JSON
            $table->integer('total_marks');
            $table->char('grade', 15);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
