<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashDisbursementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_disbursement', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->string('req_form')->nullable();
            $table->string('payee');
            $table->text('description')->nullable();
            $table->string('fund_used');
            $table->string('check_no')->nullable();
            $table->float('amount');
            $table->string('expense_type');
            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('cash_disbursement');
    }
}
