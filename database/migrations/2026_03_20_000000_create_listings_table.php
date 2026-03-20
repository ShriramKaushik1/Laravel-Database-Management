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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            
            $table->boolean('is_duplicate')->default(false);
            $table->unsignedBigInteger('merged_into_id')->nullable();
            
            $table->timestamps();

            $table->foreign('merged_into_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
