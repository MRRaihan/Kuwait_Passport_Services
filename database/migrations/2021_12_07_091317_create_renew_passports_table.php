<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenewPassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renew_passports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_creator_id')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('delivery_branch')->nullable();
            $table->unsignedBigInteger('passport_type_id')->nullable();
            $table->unsignedBigInteger('profession_id')->nullable();

            $table->string('name')->nullable();
            $table->string('emirates_id')->nullable();
            $table->string('govt_passport_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_photocopy')->nullable();
            $table->string('application_form')->nullable();
            $table->string('profession_file')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('kuwait_phone')->nullable();
            $table->string('permanent_address')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->timestamp('extended_to')->nullable();
            $table->string('bd_phone')->nullable();
            $table->string('special_skill')->nullable();
            $table->string('residence')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->string('salary')->nullable();
            $table->string('ems')->nullable();
            $table->date('dob')->nullable();

            $table->boolean('shift_to_admin')->default(0);
            $table->boolean('embassy_status')->default(0);
            $table->boolean('branch_status')->default(0);

            $table->boolean('is_delivered')->default(0);
            $table->boolean('is_shifted')->default(0);
            $table->boolean('is_received')->default(0);

            $table->string('is_manual')->nullable();
            $table->string('is_shifted_to_branch_manager')->nullable();

            $table->string('r_id')->nullable();
            $table->string('entry_person')->nullable();

            $table->string('passport_type_title')->nullable();
            $table->string('passport_type_government_fee')->nullable();
            $table->string('passport_type_versatilo_fee')->nullable();
            $table->string('passport_type_fees_total')->nullable();
            $table->string('remarks')->nullable();
            // $table->string('otp')->nullable();
            // $table->string('otp_verify_at')->nullable();
            $table->string('bio_enrollment_id')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('remarks_by')->nullable();
            $table->string('model_name')->default('Renew Passport');

            $table->boolean('delivery_method')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renew_passports');
    }
}
