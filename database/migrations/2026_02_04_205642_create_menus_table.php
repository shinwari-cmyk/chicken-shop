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
        Schema::create('menus', function (Blueprint $table) {
            $table->id(); // primary key

            $table->string('name'); // menu section name, e.g., "Chicken"
            $table->string('slug')->unique(); // URL-friendly version, e.g., "chicken"

            $table->boolean('is_active')->default(true); // active/inactive toggle

            $table->unsignedInteger('order')->default(0); // display order

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
