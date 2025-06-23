<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('my_groups', function (Blueprint $table) {
            $table->id('group_id');
            $table->string('group_name');
            $table->integer('members')->default(0);
            $table->foreignId('group_admin_id')->constrained('users')->onDelete('cascade');
            $table->string('dps_type');
            $table->string('time_period');
            $table->decimal('amount', 10, 2);
            $table->date('start_date');
            $table->decimal('goal_amount', 10, 2)->nullable();
            $table->integer('warning_time')->nullable();
            $table->decimal('emergency_fund', 10, 2)->nullable();
            $table->string('bKash')->nullable();
            $table->string('Rocket')->nullable();
            $table->string('Nagad')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('my_groups');
    }
}; 