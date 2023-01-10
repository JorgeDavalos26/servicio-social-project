<?php

use App\Enums\SolicitudeStatus;
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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("form_id")->references("id")->on("forms")->onDelete("cascade");
            $table->foreignId("period_id")->references("id")->on("periods")->onDelete("cascade");
            $table->foreignId('group_id')->nullable()->references('id')->on('groups')->nullOnDelete();
            $table->string('status', 30)->default("Nuevo");
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
        Schema::dropIfExists('solicitudes');
    }

};
