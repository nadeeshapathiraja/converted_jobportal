<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_applications', function (Blueprint $table) {
            $table->increments('candidate_application_id')->zerofill();
            $table->integer('candidate_profile_id')->default(NULL);
            $table->integer('employer_profile_id')->default(NULL);
            $table->integer('jobpost_id')->default(NULL);
            $table->enum('status', ['applied', 'withdrawn'])->default(NULL);
            $table->enum('emp_status', ['interview_invite', 'shortlist','not_suitabl'])->default(NULL);
            $table->enum('interview_status', ['accept', 'reject'])->default(NULL);
            $table->enum('final_status', ['success', 'failure'])->default(NULL);
            $table->dateTime('created_at')->default(NULL);
            $table->dateTime('updated_at')->default(NULL);
            $table->string('emp_action_by',45)->default(NULL);
            $table->dateTime('emp_action_at')->default(NULL);
            $table->dateTime('cand_action_at')->default(NULL);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_applications');
    }
}
