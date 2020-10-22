<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCataloguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price')->default(0.00);
            $table->timestamps();
        });

        Schema::create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('products_id');
            $table->integer('stock')->default(0);
            $table->timestamps();

            // Constraints
            $table->foreign('products_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('catalogues');
    }
}
