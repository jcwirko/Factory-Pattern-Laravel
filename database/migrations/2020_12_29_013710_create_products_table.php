<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price')->default(0);
            $table->timestamps();
        });

        Product::create([
            'name' => 'Pelota',
            'price' => 10
        ]);

        Product::create([
            'name' => 'Remera',
            'price' => 20
        ]);

        Product::create([
            'name' => 'Short',
            'price' => 30
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
