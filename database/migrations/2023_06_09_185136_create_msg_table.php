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
            $table->text("msg_image")->nullable();
            $table->text("msg_name")->nullable();
            $table->text("msg_picture")->nullable();
            $table->string("msg_author")->nullable();
            $table->time("schedule_start")->nullable();
            $table->timestamp('active_at')->nullable();
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
