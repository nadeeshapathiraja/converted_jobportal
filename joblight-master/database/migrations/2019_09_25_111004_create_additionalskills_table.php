<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalskillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additionalskills', function (Blueprint $table) {
            $table->increments('skill_id')->zerofill();
            $table->integer('account_id')->zerofill();
            $table->string('parent_id',50)->default(NULL);
            $table->string('parent_table',50)->default(NULL);
            $table->string('resume_id',50)->default(NULL);
            $table->longText('content')->default(NULL);
            $table->string('skill_level',15)->default(NULL);
            //$table->primary('skill_id');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additionalskills');
    }
}
