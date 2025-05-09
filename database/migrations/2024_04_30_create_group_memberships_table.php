<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_memberships', function (Blueprint $table) {
            $table->id('membership_id');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('group_id')->nullable()->constrained('my_groups', 'group_id');
            $table->enum('status', ['pending', 'active', 'rejected', 'left'])->default('pending');
            $table->boolean('is_admin')->default(false);
            $table->boolean('leave_request')->default(false);
            $table->timestamp('join_date')->nullable();
            $table->timestamp('join_request_date')->nullable();
            $table->integer('time_period_remaining')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_memberships');
    }
}; 