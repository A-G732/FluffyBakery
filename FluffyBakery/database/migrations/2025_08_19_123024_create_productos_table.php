<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('product_code');           // PK
            $table->unsignedBigInteger('id_category')->nullable(); // FK opcional
            $table->string('product_name', 100);
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discount', 5, 2)->default(0);
            $table->integer('available_unity')->default(0);
            $table->integer('minimum_stock')->nullable();
            $table->integer('maximum_stock')->nullable();
            $table->boolean('status')->default(true);
            $table->dateTime('date_add')->nullable();
            $table->dateTime('date_upd')->nullable();
            $table->integer('display_order')->nullable();
            $table->string('image')->nullable();            
            // $table->foreign('id_category')->references('id')->on('categories'); // para la tabla categorías
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
