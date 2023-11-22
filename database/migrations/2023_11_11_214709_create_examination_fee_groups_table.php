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
        Schema::create('examination_fee_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });

        DB::table('examination_fee_groups')->insert([
            ['id' => 1, 'title' => 'Regular', 'is_active'=>0],
            ['id' => 2, 'title' => 'Back', 'is_active'=>0],
            ['id' => 3, 'title' => 'Improvement', 'is_active'=>0],
            ['id' => 4, 'title' => 'Improvement', 'is_active'=>0],
            ['id' => 5, 'title' => 'Improvement', 'is_active'=>0],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examination_fee_groups');
    }
};
