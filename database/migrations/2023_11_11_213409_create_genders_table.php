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
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('slug', 50);
            $table->timestamps();
        });

        DB::table('genders')->insert([
            ['id' => 1, 'title' => 'MALE',  'slug' => 'M'],
            ['id' => 2, 'title' => 'FEMALE',  'slug' => 'F'],
            ['id' => 3, 'title' => 'TRANSGENDER',  'slug' => 'T'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genders');
    }
};
