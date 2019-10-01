<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_referrals', function (Blueprint $table) {
            $table->increments('agent_referral_id')->zerofill();
            $table->integer('account_id');
            $table->string('agent_email',200)->default(NULL);
            $table->string('document_name',500)->default(NULL);
            $table->dateTime('created_at')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_referrals');
    }
}
