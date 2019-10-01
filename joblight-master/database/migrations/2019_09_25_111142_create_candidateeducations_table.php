<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateeducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidateeducations', function (Blueprint $table) {

            $table->increments('candidate_educ_id')->zerofill();
            $table->integer('candidate_profile_id')->zerofill();
            $table->string('degree',100)->default(NULL);
            $table->string('school_type',20)->default(NULL);
            $table->string('school_name',200)->default(NULL);
            $table->string('city',50)->default(NULL);
            $table->string('country',50)->default(NULL);
            $table->string('state',50)->default(NULL);
            $table->timestamp(' enrolldate ')->default(NULL);
            $table->string('still_studying',50)->default(NULL);
            $table->timestamp('grad_date')->default(NULL);
            $table->timestamp('exp_graddate')->default(NULL);
            $table->string('is_graduated',1)->default(NULL);
            $table->timestamp('lastenrollyear')->default(NULL);
            $table->string('future_study',1)->default(NULL);
            $table->string('field_of_study',45)->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidateeducations');
    }
}
