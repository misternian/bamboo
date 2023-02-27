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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
            $table->dateTime('previous_login_at')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->integer('login_count')->unsigned()->nullable()->default(0);
            $table->string('avatar_url')->nullable();
            $table->string('real_name')->nullable();
            $table->string('phone')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'previous_login_at',
                'last_login_at', 
                'is_active', 
                'login_count',
                'avatar_url',
                'real_name',
                'phone',
            ]);
        });
    }
};
