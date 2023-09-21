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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('deadline');
            $table->string('image')->nullable();
            $table->enum('status', ['approved', 'denied', 'pending', 'completed']);
            $table->enum('department', ['design', 'development', 'marketing', 'sales']);
            $table->foreignId('approved_by')
                ->nullable()
                ->references('id')
                ->on('users');
            $table->foreignId('project_id')
                ->references('id')
                ->on('projects')
                ->nullable();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->foreignId('customer_id')
                ->references('id')
                ->on('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
