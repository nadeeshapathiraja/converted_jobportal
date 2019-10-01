<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateworkexpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidateworkexps', function (Blueprint $table) {
            $table->increments('candidate_workexp_id')->zerofill();
            $table->integer('candidate_profile_id')->zerofill();
            $table->string('employername',100)->default(NULL);
            $table->string('industry',100)->default(NULL);
            $table->string('city',50)->default(NULL);
            $table->string('country',50)->default(NULL);
            $table->string('state',50)->default(NULL);
            $table->string('position',100)->default(NULL);
            $table->timestamp(' start_date ')->default(NULL);
            $table->timestamp(' end_date ')->default(NULL);
            $table->string('still_working',10)->default(NULL);
            $table->string('salary',50)->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidateworkexps');
    }
}
