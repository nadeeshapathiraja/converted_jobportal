<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('account_id')->zerofill();
            $table->string('account_type',45)->default(NULL);
            $table->string('email',200)->unique();
            $table->string('password',100);
            $table->boolean('is_subscribed')->default(NULL);
            $table->enum('account_status', ['0', '1']);
            $table->string('created_by',45);
            $table->dateTime('account_created_at');
            $table->string('account_created_ip',45);
            $table->text('encrypted_key');
            $table->dateTime('verified_at');
            $table->text('api_token');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
