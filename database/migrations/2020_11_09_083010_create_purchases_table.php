<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date', 10);
            $table->string('invoice', 50);
            $table->bigInteger('user_id');
            $table->bigInteger('supplier_id');
            $table->integer('subtotal');
            $table->integer('vat_percentage')->nullable();
            $table->float('vat', 11, 2)->nullable();
            $table->integer('extra_cost')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->float('discount', 11, 2)->nullable();
            $table->float('total', 11, 2);
            $table->mediumText('note');
            $table->softDeletes();
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
        Schema::dropIfExists('purchases');
        $table->dropSoftDeletes();
    }
}
