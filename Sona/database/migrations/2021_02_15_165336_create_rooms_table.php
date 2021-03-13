<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string("name",50);
            $table->smallInteger("size");
            $table->smallInteger("max_persons");
            $table->string("beds", 50);
            $table->integer("price");
            $table->text("description");
            $table->smallInteger("available_rooms");
            $table->decimal("service_price_percentage")->default(1);
            $table->softDeletes("deleted_at");
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
        Schema::dropIfExists('rooms');
    }
}
