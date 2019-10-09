<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',45)->default(NULL);
            $table->string('name',45)->default(NULL);
            $table->string('email',45)->default(NULL);
            $table->string('phone',45)->default(NULL);
            $table->string('city',45)->default(NULL);
            $table->string('state',45)->default(NULL);
            $table->string('country',45)->default(NULL);
            $table->string('action_taken',45)->default(NULL);
            $table->string('updated_by',45)->default(NULL);
            $table->string('updated_at',45)->default(NULL);
            //$table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enquiries');
    }
}
