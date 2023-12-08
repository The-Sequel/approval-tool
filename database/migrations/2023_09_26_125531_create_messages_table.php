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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->foreignId('customer_id')
                ->nullable()
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->foreignId('project_id')
                ->nullable()
                ->references('id')
                ->on('projects');
            $table->foreignId('task_id')
                ->nullable()
                ->references('id')
                ->on('tasks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
