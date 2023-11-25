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
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });


        DB::table('transaction_types')->insert([
            ['id' => 1, 'title' => 'Cash Credit'],
            ['id' => 2, 'title' => 'Cash Debt'],
            ['id' => 3, 'title' => 'Bank Credit'],
            ['id' => 4, 'title' => 'Bank Debit'],
            ['id' => 5, 'title' => 'Opening Balance'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_types');
    }
};
