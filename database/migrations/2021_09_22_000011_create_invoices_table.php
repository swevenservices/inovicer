<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_number')->unique();
            $table->date('invoice_date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('company')->nullable();
            $table->longText('complete_address')->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->string('company_template')->nullable();
            $table->integer('vat')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
