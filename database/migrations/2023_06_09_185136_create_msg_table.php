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
        Schema::create('msgs', function (Blueprint $table) {
            $table->id();
            $table->string("msg_id");
            $table->string("msg_from");
            $table->string("msg_to");
            $table->text("msg_body");
            $table->text("msg_name")->nullable(true);
            $table->text("msg_image")->nullable(true);
            $table->string("msg_author")->nullable(true);
            $table->time("schedule_start")->nullable(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msgs');
    }
};
