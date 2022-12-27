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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("form_id")->references("id")->on("forms")->onDelete("cascade");
            $table->foreignId("field_id")->references("id")->on("fields")->onDelete("cascade");
            $table->boolean("hidden")->default(false);
            $table->boolean("blocked")->default(false);
            $table->boolean("required")->default(false);
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
        Schema::dropIfExists('questions');
    }
};
