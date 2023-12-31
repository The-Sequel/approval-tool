<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('customer_id')->nullable()
                ->references('id')
                ->on('customers');
            $table->foreignId('role_id')->nullable()
                ->references('id')
                ->on('roles');
            $table->foreignId('department_id')->nullable()
                ->references('id')
                ->on('departments');
            $table->text('phone_number')->nullable();
            $table->date('deleted_at')->nullable();
            $table->text('color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
