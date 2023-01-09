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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string("description", 100)->nullable();
            $table->enum('scholar_course', self::getScholarCoursesAsArray());
            $table->enum("scholar_level", self::getScholarLevelsAsArray());
            $table->string("label", 50);
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
        Schema::dropIfExists('forms');
    }

    private static function getScholarLevelsAsArray(): array
    {
        $toReturn = [];

        foreach (\App\Enums\ScholarLevel::cases() as $scholarLevel) {
            $toReturn[] = $scholarLevel->value;
        }

        return $toReturn;
    }

    private static function getScholarCoursesAsArray()
    {
        $toReturn = [];

        foreach (\App\Enums\ScholarCourse::cases() as $scholarCourse) {
            $toReturn[] = $scholarCourse->value;
        }

        return $toReturn;
    }
};
