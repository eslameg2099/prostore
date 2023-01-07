<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('address_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('status');
            $table->decimal('sub_total');
            $table->decimal('shipping_cost')->nullable()->default(0);
            $table->decimal('discount')->default(0);
            $table->unsignedInteger('payment_method');
            $table->decimal('total')->storedAs('(`sub_total` + CASE WHEN shipping_cost IS NULL THEN 0 ELSE shipping_cost END) - `discount`');
            $table->boolean('paid')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

       

        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->json('color')->nullable();
            $table->json('size')->nullable();
            $table->decimal('price');
            $table->decimal('total')->storedAs('(`price` * `quantity`)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
