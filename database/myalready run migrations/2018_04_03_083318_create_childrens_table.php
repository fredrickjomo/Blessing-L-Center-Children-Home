<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrens', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('full_name');
            $table->string('gender');
            $table->year('year_of_birth');
            $table->string('vulnerability');
            $table->string('education_level');
            $table->binary('photo');
            $table->timestamps();
        });
        DB::update('ALTER TABLE childrens AUTO_INCREMENT=1000');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('childrens');
    }
}
