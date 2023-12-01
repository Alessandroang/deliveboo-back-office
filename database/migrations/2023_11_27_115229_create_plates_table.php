<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained();
            $table->string('name', 50);
            $table->text('ingredients');
            $table->text('description')->nullable();
            $table->string('image');
            $table->decimal('price');
            $table->tinyInteger('visibility')->default(1);
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
        Schema::table('plates', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']);
            $table->dropColumn('restaurant_id');
        });

        Schema::dropIfExists('plates');
    }
};