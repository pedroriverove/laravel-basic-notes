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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->uuid('code')->unique();
            $table->text('description');
            $table->text('observations')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('department_id')->references('id')->on('departments');
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->timestamps();
            $table->timestamp('saved_at')->nullable();
            $table->timestamp('reactivated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
