<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_id')->nullable();
            $table->string('date', 10);
            $table->string('invoice', 50)->nullable();
            $table->integer('paid');
            $table->integer('due');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('supplier_id');
            $table->bigInteger('payment_method')->nullable();
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
        Schema::dropIfExists('purchase_payments');
    }
}
