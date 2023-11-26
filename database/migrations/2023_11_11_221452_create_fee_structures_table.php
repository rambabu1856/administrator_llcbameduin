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
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fee_group_head_id')->constrained('fee_group_heads')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('fee_sub_group_head_id')->constrained('fee_sub_group_heads')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('course_id')->default(1)->constrained('courses')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('batch_id')->constrained('batches')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('grade_id')->constrained('grades')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('semester_id')->nullable()->default(0)->constrained('semesters')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->decimal('amount', 10, 2)->nullable()->default(0);

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
        Schema::dropIfExists('fee_structures');
    }
};
