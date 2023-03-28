<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('password');
            $table->string('file')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('last_name')->nullable();
            /*$table->string('yandex_id');
            $table->string('park_id');
            $table->string('email')->unique();
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('password');
            $table->foreignId('work_rule_id');
            $table->string('work_status');
            $table->dateTime('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('hire_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified_date')->default(DB::raw('CURRENT_TIMESTAMP'));*/
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
