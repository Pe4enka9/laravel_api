<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hackathons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('registration_date_begin');
            $table->date('registration_date_end');
            $table->date('start_date_begin');
            $table->date('start_date_end');
            $table->integer('max_members_count');
            $table->text('description');
            $table->string('task');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hackathons');
    }
};
