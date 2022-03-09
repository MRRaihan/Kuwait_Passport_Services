<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PassportDelivires extends Migration
{
    public function up()
    {
        Schema::create('passport_deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passport_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable()->comment('0 menas renew, 1 means manual, 2 menas lost, 3 means new born baby');
            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('passport_deliveries');
    }
}
