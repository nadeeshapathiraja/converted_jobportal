<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employerprofiles', function (Blueprint $table) {
            $table->increments('employer_profile_id')->zerofill();
            $table->integer('account_id');
            $table->tinyInteger('main_account');
            $table->integer('credits');
            $table->integer('parent_account');
            $table->string('contact_person',200);
            $table->string('contact_position',150)->default(NULL);
            $table->string('contact_email',200);
            $table->string('contact_number',20)->default(NULL);
            $table->string('name',200);
            $table->string('headline',1000)->default(NULL);
            $table->text('description');
            $table->string('recruitment_type',10)->default(NULL);
            $table->integer('industry');
            $table->integer('employee_size');
            $table->string('address',1000)->default(NULL);
            $table->string('city',50)->default(NULL);
            $table->string('zip',15)->default(NULL);
            $table->string('state',50)->default(NULL);
            $table->string('country',10)->default(NULL);
            $table->string('website',2000)->default(NULL);
            $table->string('crunchbase_url',2000)->default(NULL);
            $table->string('facebook_url',2000)->default(NULL);
            $table->string('twitter_url',2000)->default(NULL);
            $table->string('video_url',2000)->default(NULL);
            $table->string('logo_url',1000)->default(NULL);
            $table->string('banner_url',1000)->default(NULL);
            $table->string('profile_url',1000)->default(NULL);
            $table->string('profile_alt_url',1000)->default(NULL);
            $table->decimal('lat', 10, 0);
            $table->decimal('lng', 10, 0);
            $table->dateTime('created_date');
            $table->dateTime('modified_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employerprofiles');
    }
}
