<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer');
            $table->foreign('customer')->references('id')->on('users')->onDelete('restrict');

            $table->unsignedBigInteger('productComplain');
            $table->foreign('productComplain')->references('id')->on('cashiers')->onDelete('restrict');

            $table->text('kontenKomplain')->nullable();
            $table->text('adminKomplain')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
