<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['новый', 'выполнен'])->default('новый');
            $table->integer('number')->unsigned();
            $table->string('customer_fio');
            $table->text('customer_komment')->nullable();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Связь с товаром
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
        Schema::dropIfExists('orders');
    }
};
