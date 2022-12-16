<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string("message")->nullable();
            $table->string("type");
            $table->string("attachment")->nullable();
            $table->unsignedBigInteger("from_id");
            $table->unsignedBigInteger("to_id");
            $table->unsignedBigInteger("conversation_id");
            $table->foreign("from_id")->references("id")->on("users");
            $table->foreign("to_id")->references("id")->on("users");
            $table->foreign("conversation_id")->references("id")->on("conversations");
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
        Schema::dropIfExists('chats');
    }
};
