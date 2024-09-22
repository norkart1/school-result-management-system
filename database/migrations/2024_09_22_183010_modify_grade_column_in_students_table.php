<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyGradeColumnInStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Modify the grade column length to 15 characters
            $table->char('grade', 15)->change();
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Revert the grade column length back to 1 character
            $table->char('grade', 1)->change();
        });
    }
}
