<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('grade_id')->nullable()->constrained('grades')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title', 50);
            $table->string('slug', 50);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });

        DB::table('semesters')->insert([
            ['id' => 1, 'course_id' => 1, 'grade_id' => 1, 'title' => '1st Semester', 'slug' => '1st', 'is_active' => 1],
            ['id' => 2, 'course_id' => 1, 'grade_id' => 1, 'title' => '2nd Semester', 'slug' => '2nd', 'is_active' => 1],
            ['id' => 3, 'course_id' => 1, 'grade_id' => 2, 'title' => '3rd Semester', 'slug' => '3rd', 'is_active' => 1],
            ['id' => 4, 'course_id' => 1, 'grade_id' => 2, 'title' => '4th Semester', 'slug' => '4th', 'is_active' => 1],
            ['id' => 5, 'course_id' => 1, 'grade_id' => 3, 'title' => '5th Semester', 'slug' => '5th', 'is_active' => 1],
            ['id' => 6, 'course_id' => 1, 'grade_id' => 3, 'title' => '6th Semester', 'slug' => '6th', 'is_active' => 1],
            ['id' => 7, 'course_id' => 2, 'grade_id' => 1, 'title' => '1st Semester', 'slug' => '1st', 'is_active' => 1],
            ['id' => 8, 'course_id' => 2, 'grade_id' => 1, 'title' => '2nd Semester', 'slug' => '2nd', 'is_active' => 1],
            ['id' => 9, 'course_id' => 2, 'grade_id' => 2, 'title' => '3rd Semester', 'slug' => '3rd', 'is_active' => 1],
            ['id' => 10, 'course_id' => 2, 'grade_id' => 2, 'title' => '4th Semester', 'slug' => '4th', 'is_active' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semesters');
    }
};
