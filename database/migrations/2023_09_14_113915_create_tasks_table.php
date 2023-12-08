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
            $table->date('deadline')->nullable();
            // $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->enum('status', ['approved', 'denied', 'pending', 'completed'])->default('pending');
            $table->foreignId('department_id')
                ->nullable()
                ->references('id')
                ->on('departments');
            $table->foreignId('approved_by')
                ->nullable()
                ->references('id')
                ->on('users');
            $table->foreignId('project_id')
                ->nullable()
                ->references('id')
                ->on('projects');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->foreignId('customer_id')
                ->references('id')
                ->on('customers');
            $table->json('assigned_to');

            // Completed
            $table->json('image_completed')->nullable();
            $table->text('description_completed')->nullable();
            $table->date('date_completed')->nullable();
            $table->foreignId('completed_by')
                ->nullable()
                ->references('id')
                ->on('users');
            $table->json('assigned_users')->nullable();
            $table->text('reason')->nullable();

            $table->json('reasons')->nullable();
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
