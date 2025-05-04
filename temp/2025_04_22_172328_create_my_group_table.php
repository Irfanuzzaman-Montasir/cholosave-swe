<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('my_group', function (Blueprint $table) {
            $table->integer('group_id', true);  // Auto-incrementing primary key
            $table->string('group_name', 255)->nullable();
            $table->integer('members')->nullable(false);
            $table->integer('group_admin_id')->nullable();
            $table->enum('dps_type', ['weekly', 'monthly'])->nullable();
            $table->integer('time_period')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->integer('goal_amount')->nullable();
            $table->integer('warning_time')->nullable();
            $table->decimal('emergency_fund', 8, 2)->nullable();
            $table->string('bKash', 255)->nullable();
            $table->string('Rocket', 255)->nullable();
            $table->string('Nagad', 255)->nullable();
            $table->timestamp('created_at')->nullable(false)->useCurrent();
            $table->text('description')->nullable();

            $table->foreign('group_admin_id')
                  ->references('id')
                  ->on('users');
            
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::dropIfExists('my_group');
    }
};
