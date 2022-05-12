<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('received', 15, 2)->nullable();
            $table->decimal('pending', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
