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
            $table->enum('status', self::getSolicitudeStatusArray())->default(SolicitudeStatus::NEW->value);
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

    private static function getSolicitudeStatusArray(): array
    {
        $toReturn = [];

        foreach (SolicitudeStatus::cases() as $solicitudeStatus) {
            $toReturn[] = $solicitudeStatus->value;
        }

        return $toReturn;
    }
};
