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
        Schema::create('examination_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->timestamps();
        });

        DB::table('examination_groups')->insert([
            ['id' => 1, 'title' => 'Regular'],
            ['id' => 2, 'title' => 'Back'],
            ['id' => 3, 'title' => 'Improvement'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examination_groups');
    }
};
