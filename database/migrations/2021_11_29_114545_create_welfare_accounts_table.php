<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWelfareAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welfare_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('codage');
            $table->string('name');
            $table->string('numcpt');
            $table->string('grpCode');
            $table->string('numcli')->nullable();
            $table->string('accType');
            $table->double('initialBal');
            $table->string('applyComis');
            $table->string('isBlocked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('welfare_accounts');
    }
}
