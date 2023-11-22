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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campus_id')->constrained('campuses')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title', 150);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });

        DB::table('departments')->insert([
            ['id' => 1, 'campus_id' => 1, 'title' => 'Lingaraj Law College', 'is_active' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
