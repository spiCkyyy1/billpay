<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->text('payment_id');
            $table->text('payment_status');
            $table->string('payer_id');
            $table->string('payer_email');
            $table->string('payer_name');
            $table->string('payer_country_code');
            $table->string('transaction_amount');
            $table->string('transaction_currency');
            $table->string('transaction_description');
            $table->string('merchant_id');
            $table->string('merchant_email');
            $table->string('commission')->nullable()->default(null);
            $table->string('transaction_create_time');
            $table->string('transaction_update_time');
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
        Schema::dropIfExists('transactions');
    }
}
