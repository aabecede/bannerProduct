<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersAddPathFoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('mysql')->hasColumn('users', 'path_foto')) {
            Schema::table('users', function (Blueprint $table) {
                $table->longText('path_foto')->nullable();
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
        if (Schema::connection('mysql')->hasColumn('users', 'path_foto')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['path_foto']);
            });
        }
    }
}
