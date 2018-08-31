<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorshipPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorship_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->year('year');
            $table->string('month');
            $table->integer('sponsor_id');
            $table->integer('child_id');
            $table->string('plan_subscribed');
            $table->double('pay',10,2);
            $table->double('amount_lack',10,2);
            $table->string('transaction_id');
            $table->string('receipt')->nullable();
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
        Schema::dropIfExists('sponsorship_payments');
    }
}
