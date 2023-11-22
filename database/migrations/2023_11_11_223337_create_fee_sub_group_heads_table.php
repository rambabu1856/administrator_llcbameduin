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
        Schema::create('fee_sub_group_heads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_group_head_id')->constrained('fee_group_heads')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('semester')->nullable()->constrained('examination_fee_groups')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('examination_fee_group_id')->nullable()->constrained('examination_fee_groups')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('title', 100);
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
        Schema::dropIfExists('fee_sub_group_heads');
    }
};
