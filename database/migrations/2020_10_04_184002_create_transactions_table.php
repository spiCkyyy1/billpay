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
            $table->text('payment_id')->nullable()->default(null);
            $table->text('payment_status')->nullable()->default(null);
            $table->string('payer_id')->nullable()->default(null);
            $table->string('payer_email')->nullable()->default(null);
            $table->string('payer_name')->nullable()->default(null);
            $table->string('payer_country_code')->nullable()->default(null);
            $table->string('transaction_amount')->nullable()->default(null);
            $table->string('transaction_currency')->nullable()->default(null);
            $table->string('transaction_description')->nullable()->default(null);
            $table->string('merchant_id')->nullable()->default(null);
            $table->string('merchant_email')->nullable()->default(null);
            $table->string('commission')->nullable()->default(null);
            $table->string('transaction_create_time')->nullable()->default(null);
            $table->string('transaction_update_time')->nullable()->default(null);
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
