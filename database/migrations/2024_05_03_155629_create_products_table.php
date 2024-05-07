<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nazwa produktu
            $table->string('producer'); // Producent
            $table->integer('product_id');
            $table->boolean('actual')->nullable();
            $table->string('price_unit'); // Jednostka ceny
            $table->decimal('weight', 8, 2)->nullable(); // Waga
            $table->decimal('diameter', 8, 2)->nullable(); // Średnica
            $table->integer('length')->nullable(); // Długość
            $table->integer('width')->nullable(); // Szerokość
            $table->integer('height')->nullable(); // Wysokość
            $table->decimal('thickness', 8, 2)->nullable(); // Grubość
            $table->string('packaging_type')->nullable(); // Typ pakowania
            $table->integer('purchase_units')->nullable(); // Jednostki zakupu
            $table->string('unit_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
