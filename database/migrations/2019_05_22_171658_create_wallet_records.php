<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount');
            $table->string('wallet_id')->unique();
            $table->string('wallet_account_id');
            $table->string('wallet_category_id');
            $table->string('wallet_currency_id');

            $table->unsignedInteger('account_id')
                ->nullable()->references('id')->on('accounts')
                ->onDelete('cascade');

            $table->unsignedInteger('category_id')
                ->nullable()->references('id')->on('catgories')
                ->onDelete('no action');

            $table->unsignedInteger('currency_id')
                ->nullable()->references('id')->on('currencies')
                ->onDelete('no action');

            $table->string('payment_type');
            $table->date('date');
            $table->integer('ref_amount');
            $table->text('note')->nullable();
            $table->string('record_state');
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
        Schema::dropIfExists('records');
    }
}
