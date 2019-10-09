<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatepreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatepreferences', function (Blueprint $table) {
            $table->increments('candidate_educ_id')->zerofill();
            $table->integer('candidate_profile_id')->default(NULL);;
            $table->text('specialization')->default(NULL);;
            $table->string('location_country',5)->default(NULL);
            $table->string('location_state',50)->default(NULL);
            $table->string('salary_currency',5)->default(NULL);
            $table->string('salary_amount',15)->default(NULL);
            //$table->primary('candidate_educ_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidatepreferences');
    }
}
