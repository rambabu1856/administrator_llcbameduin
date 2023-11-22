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
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            $table->foreignId('campus_id')->default(1)->constrained('campuses')->onUpdate('cascade');

            $table->foreignId('department_id')->default(1)->constrained('departments')->onUpdate('cascade');

            $table->foreignId('course_id')->default(1)->constrained('courses')->onUpdate('cascade');

            $table->foreignId('user_id')->nullable()->default(0)->constrained('users')->onUpdate('cascade');

            $table->foreignId('batch_id')->constrained('batches')->onUpdate('cascade');

            $table->foreignId('syllabus_year_id')->nullable()->default(0)->constrained('syllabus_years')->onUpdate('cascade');

            $table->string('registration_number', 10)->nullable();
            $table->string('registration_year', 4)->nullable();

            $table->string('examination_roll_number', 10)->nullable();
            $table->string('examination_roll_number_year', 10)->nullable();

            $table->string('image_url', 50)->nullable();
            $table->string('signature_url', 50)->nullable();

            $table->string('enrollment_number', 10);
            $table->string('student_name', 50);
            $table->string('father_name', 50)->nullable();
            $table->string('mother_name', 50)->nullable();
            $table->string('guardian_name', 50)->nullable();

            $table->dateTime('date_of_birth', $precision = 0)->nullable();

            $table->foreignId('gender_id')->constrained('genders')->onUpdate('cascade');

            $table->foreignId('community_id')->nullable()->constrained('communities')->onUpdate('cascade');

            $table->foreignId('religion_id')->nullable()->constrained('religions')->onUpdate('cascade');

            $table->foreignId('blood_group_id')->nullable()->constrained('blood_groups')->onUpdate('cascade');

            $table->foreignId('mother_tongue_id')->nullable()->constrained('mother_tongues')->onUpdate('cascade');

            $table->foreignId('nationality_id')->nullable()->constrained('nationalities')->onUpdate('cascade');

            $table->foreignId('is_pwd')->nullable()->default(false)->constrained('is_actives')->onUpdate('cascade');

            $table->foreignId('ou_bu_category_id')->nullable()->constrained('syllabus_years')->onUpdate('cascade');

            $table->string('course_year')->nullable();

            // ADDRESS
            $table->string('local_address_l1', 150)->nullable();
            $table->string('local_address_l2', 150)->nullable();
            $table->string('local_po_name', 100)->nullable();
            $table->string('local_district', 50)->nullable();
            $table->string('local_state', 50)->nullable();
            $table->integer('local_pin')->default(0);

            $table->string('permanent_address_l1', 150)->nullable();
            $table->string('permanent_address_l2', 150)->nullable();
            $table->string('permanent_po_name', 100)->nullable();
            $table->string('permanent_district', 50)->nullable();
            $table->string('permanent_state', 50)->nullable();
            $table->integer('permanent_pin')->default(0);

            $table->string('email_id', 150)->nullable();
            $table->string('phone_no', 150)->nullable();
            $table->string('phone_no_other', 150)->nullable();

            // MIGRATION
            $table->integer('list_index')->default(0);
            $table->integer('matric_return_sl_no')->default(0);
            $table->text('last_institute_name')->nullable();
            $table->text('last_university_name')->nullable();
            $table->string('last_exam_appeared', 100)->nullable();
            $table->year('last_exam_passed_year')->nullable();
            $table->string('last_exam_percentage')->nullable();

            $table->string('migration_submission_letter_no_college', 50)->nullable();
            $table->dateTime('migration_submission_date_college')->nullable();
            $table->boolean('migration_submission_status_college')->default(0);

            $table->string('migration_submission_letter_no_university', 10)->nullable();
            $table->dateTime('migration_submission_date_university')->nullable();
            $table->boolean('migration_submission_status_university')->default(0);
            $table->boolean('is_migration_received_from_bu')->default(0);
            $table->boolean('is_issued_to_student')->default(0);
            $table->dateTime('migration_issued_to_student_on')->nullable();

            $table->foreignId('is_tc_withdrawn')->nullable()->default(false)->constrained('is_actives')->onUpdate('cascade');

            $table->text('profile_remark')->nullable();

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
        Schema::dropIfExists('students');
    }
};
