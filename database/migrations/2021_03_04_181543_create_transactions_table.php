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
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('receiver_id')->unsigned()->index()->nullable();
            $table->enum('action', ['deposit', 'transfer', 'withdrawal']);
            $table->enum('type', ['debit', 'credit'])->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->text('description')->nullable();
            $table->text('response')->nullable();
            $table->double('amount', 13, 2)->default(0);
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
