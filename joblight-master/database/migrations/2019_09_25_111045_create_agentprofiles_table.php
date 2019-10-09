<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agentprofiles', function (Blueprint $table) {
            $table->increments('skill_id')->zerofill();
            $table->integer('account_id')->zerofill();
            $table->string('firstname',200)->default(NULL);
            $table->string('lastname',200)->default(NULL);
            $table->string('phone',20)->default(NULL);
            $table->string('address1',500)->default(NULL);
            $table->string('address2',500)->default(NULL);
            $table->string('city',50)->default(NULL);
            $table->string('state',50)->default(NULL);
            $table->string('country',10)->default(NULL);
            $table->string('zip',15)->default(NULL);
            $table->string('ic_no',100)->default(NULL);
            $table->string('gender',10)->default(NULL);
            $table->string('race',45)->default(NULL);
            $table->dateTime('date_of_birth')->default(NULL);
            $table->string('created_by',45)->default(NULL);
            $table->dateTime('created_at')->default(NULL);
            $table->dateTime('updated_at')->default(NULL);
            //$table->primary('skill_id');
            $table->index('skill_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agentprofiles');
    }
}
