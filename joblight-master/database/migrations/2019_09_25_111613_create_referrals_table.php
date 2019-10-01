<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('referral_id')->zerofill();
            $table->enum('referral_type', ['applicant', 'job']);
            $table->integer('candidate_profile_id')->zerofill();
            $table->integer('jobpost_id');
            $table->string('candidate_email',200)->default(NULL);
            $table->string('referral_email',200)->default(NULL);
            $table->enum('referral_status', ['invited', 'registered','viewed','completed']);
            $table->string('personal_msg',2000)->default(NULL);
            $table->integer('resume_downloads');
            $table->dateTime('expiry_date');
            $table->integer('agent_referral_id');
            $table->integer('resent_count');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referrals');
    }
}
