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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->default(1)->constrained('courses')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('batch_id')->constrained('batches')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('grade_id')->constrained('grades')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('year_id')->constrained('years')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('slug', 50);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_years');
    }
};
