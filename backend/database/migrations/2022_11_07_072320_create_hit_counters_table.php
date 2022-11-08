<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHitCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hit_counters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('article_id')->default(0);
            $table->string('page_name');
            $table->string('ip_address');
            $table->smallInteger('staying_time');
            $table->string('country');
            $table->string('city');
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
        Schema::dropIfExists('hit_counters');
    }
}
