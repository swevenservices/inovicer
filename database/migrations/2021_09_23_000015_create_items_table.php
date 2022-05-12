<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->decimal('cost_price', 15, 2)->nullable();
            $table->string('sale_price')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }
}
