<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLostPassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lost_passports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_creator_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->unsignedBigInteger('passport_type_id')->nullable();
            $table->unsignedBigInteger('de_id_for_bio')->nullable();

            $table->string('name')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('civil_id')->nullable();

            $table->string('mailing_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('ems')->nullable();
            $table->string('profession_file')->nullable();
            $table->string('passport_photocopy')->nullable();
            $table->string('kuwait_phone')->nullable();
            $table->string('bd_phone')->nullable();
            $table->string('special_skill')->nullable();
            $table->string('residence')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->string('salary')->nullable();
            $table->timestamp('date')->nullable();
            $table->date('dob')->nullable();
            $table->string('delivery_branch')->nullable();
            $table->string('gd_report_kuwait')->nullable();
            $table->string('application_form')->nullable();

            $table->boolean('shift_to_admin')->default(0)->comment('1 = branch manager to admin ');
            $table->boolean('embassy_status')->default(0)->comment('1 = receive from admin , 3 = send to admin ');
            $table->boolean('branch_status')->default(0)->comment('0 = nothing , 1 = received from admin , 3 = delivery to user ');

            $table->boolean('is_delivered')->default(0);

            $table->string('is_shifted_to_branch_manager')->nullable();

            $table->string('passport_type_title')->nullable();
            $table->string('passport_type_government_fee')->nullable();
            $table->string('passport_type_versatilo_fee')->nullable();
            $table->string('passport_type_fees_total')->nullable();
            $table->string('r_id')->nullable();
            $table->string('entry_person')->nullable();
            $table->string('otp')->nullable();
            $table->string('otp_verify_at')->nullable();
            $table->boolean('status')->default(1);
            $table->string('bio_enrollment_id')->nullable();
            $table->string('new_mrp_passport_no')->nullable();
            $table->string('remarks')->nullable();
            $table->boolean('remarks_by')->nullable();

            $table->boolean('delivery_method')->nullable();

            $table->string('model_name')->default('Lost Passport');


            $table->timestamps();
            $table->softDeletes();
            // doesn't used status start
            $table->boolean('is_shifted')->default(0);
            // doesn't used status end
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lost_passports');
    }
}
