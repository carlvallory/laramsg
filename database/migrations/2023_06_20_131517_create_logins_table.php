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
        Schema::create('logins', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('user', 16);
            $table->boolean('status');
            $table->timestamps();
        });

        /* Schema::table('schedules', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('schedules')->onUpdate('cascade')->onDelete('cascade');
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logins');
    }
};
