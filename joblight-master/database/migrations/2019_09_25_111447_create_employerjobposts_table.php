<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerjobpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employerjobposts', function (Blueprint $table) {
            $table->increments('jobpost_id')->zerofill();
            $table->integer('employer_profile_id');
            $table->string('company_name',200)->default(NULL);
            $table->string('locality_city',50)->default(NULL);
            $table->string('locality_country',5)->default(NULL);
            $table->string('job_title',200)->default(NULL);
            $table->string('job_city',200)->default(NULL);
            $table->string('job_state',200)->default(NULL);
            $table->string('job_country',5)->default(NULL);
            $table->string('job_category',8)->default(NULL);
            $table->string('job_level',5)->default(NULL);
            $table->string('job_type',5)->default(NULL);
            $table->string('salary_currency',8)->default(NULL);
            $table->decimal('salary_max', 10, 0);
            $table->decimal('salary_min', 10, 0);
            $table->text('job_description');
            $table->longText('logo_url');
            $table->longText('banner_url');
            $table->enum('application_receive_mode', ['url', 'email']);
            $table->integer('notification_type');
            $table->longText('company_url');
            $table->text('company_email');
            $table->enum('status', ['draft', 'posted','terminated','expired']);
            $table->dateTime('posted_at');
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
            $table->integer('posted_by');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->char('is_confidential', 1);
            //$table->primary('jobpost_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employerjobposts');
    }
}
