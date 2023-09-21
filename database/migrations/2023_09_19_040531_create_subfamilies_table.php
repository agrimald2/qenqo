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
        Schema::create('subfamilies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id');
            $table->string('name');
            $table->boolean('is_enabled')->default(true);
            $table->boolean('required_admin_permission')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subfamilies');
    }
};
