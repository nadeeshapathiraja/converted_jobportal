<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLookupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookups', function (Blueprint $table) {
            $table->increments('lookup_id');
            $table->string('lookup_type',100)->default(NULL);
            $table->string('lookup_sub_type',100)->default(NULL);
            $table->string('lookup_code',50)->default(NULL);
            $table->string('lookup_name',200)->default(NULL);
            $table->tinyInteger('active_ind')->default(NULL);
            $table->string('set_order',45)->default(NULL);
            $table->string('created_by',45)->default(NULL);
            $table->dateTime('created_at')->default(NULL);
            $table->string('updated_by',45)->default(NULL);
            $table->dateTime('updated_at')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lookups');
    }
}
