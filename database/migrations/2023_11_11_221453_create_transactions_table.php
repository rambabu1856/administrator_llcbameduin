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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('sbc_category_name', 100)->nullable();
            $table->string('student_name', 100)->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('application_id', 100)->nullable();
            $table->string('enrollment_no', 100)->nullable();
            $table->foreignId('grade_id')->nullable()->constrained('grades')->default(0)->onUpdate('cascade');
            $table->string('grade_name', 100)->nullable();
            $table->foreignId('semester_id')->nullable()->constrained('semesters')->default(0)->onUpdate('cascade');
            $table->string('semester_name', 100)->nullable();
            $table->foreignId('academic_year_id')->nullable()->default(0)->constrained('academic_years')->onUpdate('cascade')->comment('Academic Year/Year');
            $table->string('academic_year', 20)->nullable();
            $table->foreignId('mode_of_transaction_id')->nullable()->constrained('mode_of_transactions')->onUpdate('cascade')->comment('SBC, Cash etc');
            $table->string('transaction_reference_no', 20)->nullable();

            $table->foreignId('fee_group_head_id')->nullable()->constrained('fee_group_heads')->onUpdate('cascade')->comment('Fee: Main Head');

            $table->foreignId('fee_sub_group_heads')->nullable()->default(0)->constrained('fee_sub_group_heads')->onUpdate('cascade')->comment('Fee: Main Head->Sub Head/Head of Account');

            $table->text('description')->nullable();

            $table->string('sanction_order_no', 50)->nullable();
            $table->dateTime('sanction_order_date', $precision = 0)->nullable();

            $table->foreignId('creditor_id')->nullable()->default(0)->constrained('creditors')->onUpdate('cascade')->comment('To whom amout Paid');

            $table->string('voucher_no', 50)->nullable();

            $table->foreignId('transaction_type_id')->constrained('transaction_types')->onUpdate('cascade')->comment('Cash Credit, Cash Debit, Bank Credit, Bank Debit etc');

            $table->dateTime('transaction_date', $precision = 0)->nullable();

            $table->boolean('is_advance')->nullable()->default(false);
            $table->boolean('is_contra')->nullable()->default(false);
            $table->integer('contra_vr_no')->nullable()->default(0);
            $table->boolean('is_ob')->nullable()->default(false);

            $table->decimal('receipt_amount', 10, 2)->nullable()->default(0);
            $table->decimal('payment_amount', 10, 2)->nullable()->default(0);

            $table->text('payment_remarks')->nullable();
            $table->text('student_remark')->nullable();
            $table->text('office_remark')->nullable();
            $table->text('office_remark_1')->nullable();

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
        Schema::dropIfExists('transactions');
    }
};
