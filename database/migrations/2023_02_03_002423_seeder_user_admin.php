<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeederUserAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::updateOrCreate(
            [
                'email' => 'admin@vascom.com',
                'phone' => '123456789',
            ],
            [
                'name' => 'admin',
                'password' => bcrypt('1234567'),
                'is_verified' => 1,
                'is_admin' => 1
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
