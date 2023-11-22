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
        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('academic_year_start', $precision = 0)->nullable();
            $table->dateTime('academic_year_end', $precision = 0)->nullable();
            $table->dateTime('financial_year_start', $precision = 0)->nullable();
            $table->dateTime('financial_year_end', $precision = 0)->nullable();
            $table->timestamps();
        });

        DB::table('years')->insert([
            ['id' => 1, 'title' => '2001-2002', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 2, 'title' => '2002-2003', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 3, 'title' => '2003-2004', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 4, 'title' => '2004-2005', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 5, 'title' => '2005-2006', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 6, 'title' => '2006-2007', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 7, 'title' => '2007-2008', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 8, 'title' => '2008-2009', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 9, 'title' => '2009-2010', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 10, 'title' => '2010-2011', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 11, 'title' => '2011-2012', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 12, 'title' => '2012-2013', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 13, 'title' => '2013-2014', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 14, 'title' => '2014-2015', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 15, 'title' => '2015-2016', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 16, 'title' => '2016-2017', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 17, 'title' => '2017-2018', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 18, 'title' => '2018-2019', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 19, 'title' => '2019-2020', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 20, 'title' => '2020-2021', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 21, 'title' => '2021-2022', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 22, 'title' => '2022-2023', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 23, 'title' => '2023-2024', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
            ['id' => 24, 'title' => '2024-2025', 'academic_year_start' => null,  'academic_year_end' => null, 'financial_year_start' => null,   'financial_year_end' => null],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('years');
    }
};
