<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('empid')->unique(); // Company-specific ID
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('designation');
            $table->string('department');
            $table->date('joining_date');
            $table->decimal('salary', 10, 2);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

