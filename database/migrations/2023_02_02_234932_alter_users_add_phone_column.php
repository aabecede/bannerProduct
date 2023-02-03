<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersAddPhoneColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('mysql')->hasColumn('users', 'phone')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone', 15);
            });
        }
        if (!Schema::connection('mysql')->hasColumn('users', 'is_verified')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('is_verified')->comment('1 verified, 2 not verified')->nullable()->length(1);
            });
        }
        if (!Schema::connection('mysql')->hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('is_admin')->nullable()->length(1)->comment('is_admin 1 = admin');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::connection('mysql')->hasColumn('users', 'phone')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone');
            });
        }
        if (Schema::connection('mysql')->hasColumn('users', 'is_verified')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_verified');
            });
        }
        if (Schema::connection('mysql')->hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_admin');
            });
        }
    }
}
