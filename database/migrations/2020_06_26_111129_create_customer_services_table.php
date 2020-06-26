<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_services', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 18)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status', 10);
            $table->timestamps();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->bigInteger('customer_service_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('customer_service_id');
        });
        Schema::dropIfExists('customer_services');
    }
}
