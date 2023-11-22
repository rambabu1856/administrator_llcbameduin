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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title', 50);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });

        DB::table('batches')->insert([
            ['id' => 1, 'course_id' => 1, 'title' => '2001-2004',  'is_active' => 0],
            ['id' => 2, 'course_id' => 1, 'title' => '2002-2005',  'is_active' => 0],
            ['id' => 3, 'course_id' => 1, 'title' => '2003-2006',  'is_active' => 0],
            ['id' => 4, 'course_id' => 1, 'title' => '2004-2007',  'is_active' => 0],
            ['id' => 5, 'course_id' => 1, 'title' => '2005-2008',  'is_active' => 0],
            ['id' => 6, 'course_id' => 1, 'title' => '2006-2009',  'is_active' => 0],
            ['id' => 7, 'course_id' => 1, 'title' => '2007-2010',  'is_active' => 0],
            ['id' => 8, 'course_id' => 1, 'title' => '2008-2011',  'is_active' => 0],
            ['id' => 9, 'course_id' => 1, 'title' => '2009-2012',  'is_active' => 0],
            ['id' => 10, 'course_id' => 1, 'title' => '2010-2013',  'is_active' => 0],
            ['id' => 11, 'course_id' => 1, 'title' => '2011-2014',  'is_active' => 0],
            ['id' => 12, 'course_id' => 1, 'title' => '2012-2015',  'is_active' => 0],
            ['id' => 13, 'course_id' => 1, 'title' => '2013-2016',  'is_active' => 0],
            ['id' => 14, 'course_id' => 1, 'title' => '2014-2017',  'is_active' => 0],
            ['id' => 15, 'course_id' => 1, 'title' => '2015-2018',  'is_active' => 0],
            ['id' => 16, 'course_id' => 1, 'title' => '2016-2019',  'is_active' => 0],
            ['id' => 17, 'course_id' => 1, 'title' => '2017-2020',  'is_active' => 0],
            ['id' => 18, 'course_id' => 1, 'title' => '2018-2021',  'is_active' => 0],
            ['id' => 19, 'course_id' => 1, 'title' => '2019-2022',  'is_active' => 0],
            ['id' => 20, 'course_id' => 1, 'title' => '2020-2023',  'is_active' => 0],
            ['id' => 21, 'course_id' => 1, 'title' => '2021-2024',  'is_active' => 0],
            ['id' => 22, 'course_id' => 1, 'title' => '2022-2025',  'is_active' => 0],
            ['id' => 23, 'course_id' => 1, 'title' => '2023-2026',  'is_active' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batches');
    }
};
