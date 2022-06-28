<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskRepTypereasonSysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('risk_rep_typereason_sys'))
        {
        Schema::create('risk_rep_typereason_sys', function (Blueprint $table) {
            $table->id("RISK_REPTYPERESONSYS_ID",11);          
            $table->String("RISK_REPTYPERESONSYS_NAME",255)->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risk_rep_typereason_sys');
    }
}
