<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_receipt', function (Blueprint $table) {
            $table->id()->autoIncrement(0300);
            $table->unsignedBigInteger('rotary_id');
            $table->date('date');
            $table->float('amount');
            $table->string('type_of_payment');
            $table->string('mode_of_payment');
            $table->string('remarks')->nullable();



            $table->timestamps();

             // Define foreign key relationship
             $table->foreign('rotary_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_receipt');
    }
}
