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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title', 50);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });

        DB::table('courses')->insert([
            ['id' => 1, 'department_id' => 1, 'title' => 'LL.B.',  'is_active' => 1],
            ['id' => 2, 'department_id' => 1, 'title' => 'LL.M.',  'is_active' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
