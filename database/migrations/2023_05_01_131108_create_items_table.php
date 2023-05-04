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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('category_id');
            $table->longText('description');
            $table->string('price');
            $table->string('publish')->nullable();
            $table->string('owner_name');
            $table->string('contact_number');
            $table->text('address');
            $table->enum('condition', ['new', 'used']);
            $table->enum('type', ['buy', 'sell', 'exchange']);
            $table->longText('image');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};