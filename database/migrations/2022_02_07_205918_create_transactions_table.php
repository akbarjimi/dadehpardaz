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
            $table->unsignedBigInteger('national_id');
            $table->bigInteger('amount');
            $table->boolean('succeeded')->default(false);
            $table->string('driver')->nullable(); // You can find the driver ID in enum/psp.php.
            $table->string('authority')->nullable(); // Token to go to the bank portal
            $table->string('reference_id')->nullable(); // Reference for payment
            $table->json('additional')->nullable(); // It needs transform layer, appends every response from PSP
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->index(['national_id', 'succeeded']);
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
