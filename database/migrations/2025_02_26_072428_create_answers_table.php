<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hackathon_id');
            $table->text('text');
            $table->timestamps();

            $table->foreign('hackathon_id')->references('id')->on('hackathons');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
