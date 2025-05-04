<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('group_membership', function (Blueprint $table) {
            $table->integer('membership_id', true);  // Auto-incrementing primary key
            $table->integer('group_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->tinyInteger('is_admin')->default(0);
            $table->enum('leave_request', ['pending', 'approved', 'declined', 'no'])->default('no');
            $table->date('join_date')->nullable();
            $table->date('join_request_date')->nullable();
            $table->integer('time_period_remaining')->nullable();
            $table->timestamps();

            $table->foreign('group_id')
                  ->references('group_id')
                  ->on('my_group');
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
            
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_membership');
    }
};
