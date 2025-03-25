<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->enum('urgency', config('constants.urgencies'))->default('flexible');
            $table->string('property');
            $table->boolean('standard')->default(true);
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
