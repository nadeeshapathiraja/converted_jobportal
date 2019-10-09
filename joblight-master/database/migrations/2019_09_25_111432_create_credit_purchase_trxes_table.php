<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditPurchaseTrxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_purchase_trxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_no',250)->default(NULL);
            $table->integer('employer_profile_id');
            $table->string('pack_name',250)->default(NULL);
            $table->integer('credits');
            $table->dateTime('created_at');
            $table->string('status',250)->default(NULL);
           //$table->primary('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_purchase_trxes');
    }
}
