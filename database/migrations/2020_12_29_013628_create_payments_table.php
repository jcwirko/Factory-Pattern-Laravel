<?php

use App\Values\PaymentStatusValue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->enum('status', [
                PaymentStatusValue::PENDING,
                PaymentStatusValue::SUCCESSFUL
            ]);
            $table->float('amount');
            $table->text('products')->nullable();
            $table->string('payment_platform_id')->unique()->index();
            $table->json('detail');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
