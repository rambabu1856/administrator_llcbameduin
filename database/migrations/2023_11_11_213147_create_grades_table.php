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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->default(1)->constrained('departments')->onUpdate('cascade');
            $table->string('title', 50);
            $table->string('slug', 50);
            $table->timestamps();
        });

        DB::table('grades')->insert([
            ['id' => 1, 'department_id' => 1, 'title' => 'Pre Law/1st Year',  'slug' => 'P'],
            ['id' => 2, 'department_id' => 1, 'title' => 'Inter Law/2nd Year',  'slug' => 'I'],
            ['id' => 3, 'department_id' => 1, 'title' => 'Final Law/3rd Year',  'slug' => 'F'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
