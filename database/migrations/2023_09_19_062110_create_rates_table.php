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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subfamily_id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->integer('duration');
            $table->boolean('haveDiet');
            $table->integer('nutritional_assessments');
            $table->integer('max_freeze_days');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
