<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_ports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ports_id');
            $table->Integer('status');
            $table->string('nom')->nullable();
            $table->string('mid')->nullable();
            $table->string('inv')->nullable();
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
        Schema::dropIfExists('order_ports');
    }
}
