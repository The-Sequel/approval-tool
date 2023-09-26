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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->enum('status', ['approved', 'denied', 'pending', 'completed']);
            $table->string('created_by');
            $table->string('approved_by')->nullable();
            $table->date('deadline');
            $table->foreignId('department_id')
                ->references('id')
                ->on('departments');
            $table->foreignId('customer_id')
                ->references('id')
                ->on('customers');
            // $table->integer('prio_level')->default(3);
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
