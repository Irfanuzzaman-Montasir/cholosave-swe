<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('group_membership', function (Blueprint $table) {
            $table->id('membership_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('group_id')->constrained('my_groups')->onDelete('cascade');
            $table->enum('status', ['pending', 'active', 'rejected', 'left'])->default('pending');
            $table->boolean('is_admin')->default(false);
            $table->boolean('leave_request')->default(false);
            $table->timestamp('join_date')->nullable();
            $table->timestamp('join_request_date')->nullable();
            $table->integer('time_period_remaining')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'group_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_membership');
    }
}; 