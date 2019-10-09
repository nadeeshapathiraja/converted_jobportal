<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateSavedapplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_savedapplications', function (Blueprint $table) {
            $table->increments('candidate_saved_application_id')->zerofill();
            $table->integer('candidate_profile_id');
            $table->integer('jobpost_id');
            $table->dateTime('created_at');
            //$table->primary('candidate_saved_application_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_savedapplications');
    }
}
