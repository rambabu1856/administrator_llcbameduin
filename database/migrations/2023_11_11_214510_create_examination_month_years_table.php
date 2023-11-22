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
        Schema::create('examination_month_years', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });

        DB::table('examination_month_years')->insert([
            ['id' => 1, 'title' => 'DEC-2022'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examination_month_years');
    }
};
