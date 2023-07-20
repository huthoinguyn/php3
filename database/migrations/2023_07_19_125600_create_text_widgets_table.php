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
        Schema::create('text_widgets', function (Blueprint $table){
            $table->id();
            $table->string('key', 255)->unique();
            $table->string('title', 2048);
            $table->string('image', 255)->nullable();
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    : void{
        Schema::dropIfExists('text_widgets');
    }
};
