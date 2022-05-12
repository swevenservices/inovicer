<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->datetime('start');
            $table->date('end')->nullable();
            $table->string('description')->nullable();
            $table->string('model')->nullable();
            $table->string('model_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
