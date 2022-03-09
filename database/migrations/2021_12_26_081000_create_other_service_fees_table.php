<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherServiceFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_service_fees', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('service_type')->nullable();
            $table->string('versetilo_fee')->nullable();
            $table->string('agency_fee')->nullable();
            $table->string('govt_fee')->nullable();
            $table->string('consultants_fee')->nullable();
            $table->string('other_fee')->nullable();
            $table->enum('service_status', ['0', '1', '2'])->default(null);
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('other_service_fees');
    }
}
