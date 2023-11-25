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
        Schema::create('admins', function (Blueprint $table) {

            $table->id();

            $table->string('name', 100)->nullable();
            $table->integer('role')->nullable()->default(0);

            $table->foreignId('campus_id')->constrained('campuses')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('course_id')->constrained('courses')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
