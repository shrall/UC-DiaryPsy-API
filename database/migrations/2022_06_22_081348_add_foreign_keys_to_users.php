<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->index()->nullable();
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->unsignedBigInteger('religion_id')->index()->nullable();
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->unsignedBigInteger('tribe_id')->index()->nullable();
            $table->foreign('tribe_id')->references('id')->on('tribes')->onDelete('cascade');
            $table->char('city_id', 4)->after('tribe_id')->nullable();
            $table->foreign('city_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->unsignedBigInteger('role_id')->index()->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
