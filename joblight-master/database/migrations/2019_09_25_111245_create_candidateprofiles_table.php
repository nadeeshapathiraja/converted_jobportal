<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidateprofiles', function (Blueprint $table) {
            $table->increments('candidate_profile_id')->zerofill();
            $table->integer('account_id')->zerofill();
            $table->string('firstname',200)->default(NULL);
            $table->string('lastname',200)->default(NULL);
            $table->string('mobile',20)->default(NULL);
            $table->string('telephone',20)->default(NULL);
            $table->string('address1',200)->default(NULL);
            $table->string('address2',200)->default(NULL);
            $table->string('city',50)->default(NULL);
            $table->string('state',50)->default(NULL);
            $table->string('country',5)->default(NULL);
            $table->string('zipcode',15)->default(NULL);
            $table->string('profile_picture',500)->default(NULL);
            $table->tinyInteger('fresh_graduate')->default(NULL);
            $table->string('nationality',200)->default(NULL);
            $table->string('country_residingin',5)->default(NULL);
            $table->string('state_residingin',50)->default(NULL);
            $table->string('working_since',4)->default(NULL);
            $table->string('prefered_category',8)->default(NULL);
            $table->string('prefered_level',5)->default(NULL);
            $table->string('prefered_type',5)->default(NULL);
            $table->string('prefered_salary_currency',8)->default(NULL);
            $table->decimal('prefered_salary',10, 0)->default(NULL);
            $table->string('prefered_location',5)->default(NULL);
            $table->text('about_myself')->default(NULL);
            $table->string('gender',10)->default(NULL);
            $table->dateTime('date_of_birth')->default(NULL);
            $table->longText('core_skills')->default(NULL);
            $table->string('race',50)->default(NULL);
            $table->string('prefered_location2',5)->default(NULL);
            $table->string('prefered_location3',5)->default(NULL);
            $table->string('prefered_industry',45)->default(NULL);
            $table->string('acc_name',150)->default(NULL);
            $table->string('acc_no',45)->default(NULL);
            $table->string('bank',150)->default(NULL);
            //$table->primary('candidate_profile_id');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidateprofiles');
    }
}
