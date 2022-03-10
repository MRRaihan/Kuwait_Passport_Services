<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('profession_id')->nullable();

            $table->string('name')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_type_id')->nullable();
            $table->string('emirates_id')->nullable();
            // $table->string('govt_passport_id')->nullable();
            $table->string('passport_photocopy')->nullable();
            $table->string('profession_file')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('kuwait_phone')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('bd_phone')->nullable();
            $table->string('special_skill')->nullable();
            $table->string('residence')->nullable();
            $table->string('salary')->nullable();
            $table->string('fee')->nullable();
            $table->string('remarks')->nullable();
            $table->string('ems')->nullable();
            // $table->timestamp('date')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->string('delivery_branch')->nullable();
            $table->date('dob')->nullable();

            // $table->boolean('shift_to_admin')->default(0);
            // $table->boolean('embassy_status')->default(0);
            // $table->boolean('branch_status')->default(0);





            // $table->string('r_id')->nullable();
            $table->string('entry_person')->nullable();
            // $table->string('otp')->nullable();
            // $table->string('otp_verify_at')->nullable();
            $table->boolean('status')->nullable();
            // $table->string('bio_enrollment_id')->nullable();
            // $table->boolean('remarks_by')->nullable();
            // $table->string('model_name')->default('Other Service');

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
        Schema::dropIfExists('others');
    }
}
