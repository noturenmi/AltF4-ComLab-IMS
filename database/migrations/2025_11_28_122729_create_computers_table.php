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
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_id')->nullable();
            $table->string('name');
            $table->string('model');
            $table->enum('status', ['Active', 'Inactive', 'Maintenance'])->default('Inactive');
            $table->date('assigned_date');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('lab_id')->references('id')->on('laboratories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computers');
    }
};
