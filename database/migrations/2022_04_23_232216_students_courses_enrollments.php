<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_courses_enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("students_id");
            $table->unsignedBigInteger("courses_id");
            $table->unsignedBigInteger("enrolled_by_users_id");
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("students_id")->references("id")->on("students");
            $table->foreign("courses_id")->references("id")->on("courses");
            $table->foreign("enrolled_by_users_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_courses_enrollments');
    }
};
