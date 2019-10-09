<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_languages', function (Blueprint $table) {
            $table->increments('candidate_lang_id')->zerofill();
            $table->integer('candidate_profile_id');
            $table->string('language_code',45)->default(NULL);
            $table->string('spoken_level',45)->default(NULL);
            $table->string('written_level',45)->default(NULL);
            $table->string('default',45)->default(NULL);
            //$table->primary('candidate_lang_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_languages');
    }
}
