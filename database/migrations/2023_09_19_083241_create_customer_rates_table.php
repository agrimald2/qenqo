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
        Schema::create('customer_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('rate_name');
            $table->string('rate_description');
            $table->decimal('rate_total_price', 8, 2);
            $table->integer('rate_total_sessions');
            $table->decimal('total_payed', 8, 2)->default(0);
            $table->decimal('total_consumed', 8, 2)->default(0);
            $table->integer('nutritional_assessment_total')->default(0);
            $table->integer('nutritional_assessment_consumed')->default(0);
            $table->integer('max_freeze_days')->default(0);
            $table->date('start_day')->nullable();
            $table->date('end_day')->nullable();
            $table->unsignedBigInteger('customer_rate_status_id')->default(1);
            $table->string('added_by');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_rates');
    }
};
