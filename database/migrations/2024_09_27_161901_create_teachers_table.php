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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_first_name');
            $table->string('teacher_middle_name');
            $table->string('teacher_last_name');
            $table->string('department');
            $table->timestamps();

            $table->foreign('department')->references('department_id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_subject');
        Schema::dropIfExists('teacher_block');
        Schema::dropIfExists('teachers');
    }
};
