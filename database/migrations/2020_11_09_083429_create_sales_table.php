<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date', 10);
            $table->string('invoice', 50);
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('customer_id');
            $table->integer('subtotal');
            $table->integer('vat_percentage')->nullable();
            $table->float('vat', 11, 2)->nullable();
            $table->integer('extra_cost')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->float('discount', 11, 2)->nullable();
            $table->float('total', 11, 2);
            $table->mediumText('note')->nullable();
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
        Schema::dropIfExists('sales');
        $table->dropSoftDeletes();
    }
}
