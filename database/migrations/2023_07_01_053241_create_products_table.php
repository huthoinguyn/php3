<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    /**
     * Run the migrations.
     */
    public function up()
    : void{
        Schema::create('products', function (Blueprint $table){
            $table->id();
            $table->string('name', 2048);
            $table->string('slug', 2048);
            $table->double('price');
            $table->string('image', 2048);
            $table->longText('description');
            $table->text('summary');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->boolean('featured');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    : void{
        Schema::dropIfExists('products');
    }
};
