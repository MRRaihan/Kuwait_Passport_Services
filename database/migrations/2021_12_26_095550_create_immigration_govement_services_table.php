<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmigrationGovementServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immigration_govement_services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();

            $table->string('passport_number')->nullable();
            $table->string('passport_photocopy')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('kuwait_phone')->nullable();
            $table->string('bd_phone')->nullable();
            $table->longText('permanent_address')->nullable();
            $table->date('expiry_date')->nullable();
            $table->date('extended_to')->nullable();
            $table->string('special_skill')->nullable();
            $table->string('residence')->nullable();
            $table->string('salary')->nullable();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('other_service_fee_id')->nullable();
            $table->string('versetilo_fee')->nullable();
            $table->string('agency_fee')->nullable();
            $table->string('govt_fee')->nullable();
            $table->string('consulttants_fee')->nullable();
            $table->string('other_fee')->nullable();
            $table->string('total_fee')->nullable();
            $table->string('passport_id')->nullable();
            $table->string('passport_type')->nullable();
            $table->longText('service_taken')->nullable();
            $table->boolean('status')->nullable();
            $table->string('deleted_by')->nullable();
            $table->string('ems')->nullable();
            $table->string('model_name')->default('Immigration Govt. Service');
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
        Schema::dropIfExists('immigration_govement_services');
    }
}
