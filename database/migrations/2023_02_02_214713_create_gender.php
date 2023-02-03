<?php

use App\Models\Gender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('gender')) {
            Schema::create('gender', function (Blueprint $table) {
                $table->id();
                $table->string('name', '11');
                $table->integer('created_by');
                $table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        Gender::insert([
            [
                'name' => 'Male',
                'created_by' => 0,
            ],
            [
                'name' => 'Female',
                'created_by' => 0,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gender');
    }
}
