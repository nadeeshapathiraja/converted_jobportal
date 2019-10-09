<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerResumeDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_resume_downloads', function (Blueprint $table) {
            $table->increments('employer_resume_download_id');
            $table->integer('employer_profile_id');
            $table->integer('candidate_profile_id');
            $table->enum('download_source', ['talent_search', 'job_applicant'])->default(NULL);
            $table->integer('credits_used')->default(NULL);
            $table->integer('job_post_id')->default(NULL);
            $table->longText('emailed_addresses')->default(NULL);
            $table->enum('status', ['downloaded', 'expired'])->default(NULL);
            $table->dateTime('expiry_date')->default(NULL);
            $table->dateTime('created_at')->default(NULL);
            //$table->primary('employer_resume_download_id');
            $table->index('employer_resume_download_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employer_resume_downloads');
    }
}
