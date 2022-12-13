<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Field;
use App\Models\Form;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //------------------------------------ users

        $user1 = User::factory()->create([
            "email" => "user1@gmail.com"
        ]);

        $user2 = User::factory()->create([
            "email" => "user2@gmail.com"
        ]);

        $user3 = User::factory()->create([
            "email" => "user3@gmail.com"
        ]);

        $user4 = User::factory()->create([
            "email" => "user4@gmail.com"
        ]);

        //------------------------------------ forms

        $form1 = Form::factory()->create([
            "type" => "PROPEDEUTICO",
            "level" => "TECNOLOGO",
            "version" => "2023",
        ]);

        $form2 = Form::factory()->create([
            "type" => "PROPEDEUTICO",
            "level" => "INGENIERIA",
            "version" => "2023",
        ]);

        $form3 = Form::factory()->create([
            "type" => "NIVELACION",
            "level" => "TECNOLOGO",
            "version" => "2023",
        ]);

        $form4 = Form::factory()->create([
            "type" => "NIVELACION",
            "level" => "INGENIERIA",
            "version" => "2023",
        ]);

        //------------------------------------ fields

        Field::factory()->create(["description" => "curp"]);
        Field::factory()->create(["description" => "nombre"]);
        Field::factory()->create(["description" => "paterno"]);
        Field::factory()->create(["description" => "materno"]);
        Field::factory()->create(["description" => "correo"]);
        Field::factory()->create(["description" => "celular"]);
        Field::factory()->create(["description" => "telefono"]);
        Field::factory()->create(["description" => "calle"]);
        Field::factory()->create(["description" => "exterior"]);
        Field::factory()->create(["description" => "interior"]);
        Field::factory()->create(["description" => "colonia"]);
        Field::factory()->create(["description" => "cp"]);
        Field::factory()->create(["description" => "municipio"]);
        Field::factory()->create(["description" => "estados_id"]);
        Field::factory()->create(["description" => "telefono_fam"]);
        Field::factory()->create(["description" => "estadocivil"]);
        Field::factory()->create(["description" => "sexo"]);
        Field::factory()->create(["description" => "fecha_nacimiento"]);
        Field::factory()->create(["description" => "nacionalidad"]);
        Field::factory()->create(["description" => "pais_nacimiento"]);
        Field::factory()->create(["description" => "edo_nacimiento"]);
        Field::factory()->create(["description" => "mpio_nacimiento"]);
        Field::factory()->create(["description" => "num_hermanos"]);
        Field::factory()->create(["description" => "lugar_hermanos"]);
        Field::factory()->create(["description" => "tiene_hermano"]);
        Field::factory()->create(["description" => "aspirantes_hermanos_ceti_id"]);
        Field::factory()->create(["description" => "aspirantes_catmedios_id"]);
        Field::factory()->create(["description" => "otro_nivel"]);

        // there are more...WIP

        //------------------------------------ questions

        Question::factory()->create(["form_id" => 1, "field_id" => 1]);
        Question::factory()->create(["form_id" => 1, "field_id" => 2]);
        Question::factory()->create(["form_id" => 1, "field_id" => 3]);
        Question::factory()->create(["form_id" => 1, "field_id" => 4]);
        Question::factory()->create(["form_id" => 1, "field_id" => 5]);
        Question::factory()->create(["form_id" => 1, "field_id" => 6]);
        Question::factory()->create(["form_id" => 1, "field_id" => 7]);
        Question::factory()->create(["form_id" => 1, "field_id" => 8]);
        Question::factory()->create(["form_id" => 1, "field_id" => 9]);
        Question::factory()->create(["form_id" => 1, "field_id" => 10]);
        Question::factory()->create(["form_id" => 1, "field_id" => 11]);
        Question::factory()->create(["form_id" => 1, "field_id" => 12]);
        Question::factory()->create(["form_id" => 1, "field_id" => 13]);
        Question::factory()->create(["form_id" => 1, "field_id" => 14]);
        Question::factory()->create(["form_id" => 1, "field_id" => 15]);
        Question::factory()->create(["form_id" => 1, "field_id" => 16]);
        Question::factory()->create(["form_id" => 1, "field_id" => 17]);
        Question::factory()->create(["form_id" => 1, "field_id" => 18]);
        Question::factory()->create(["form_id" => 1, "field_id" => 19]);
        Question::factory()->create(["form_id" => 1, "field_id" => 20]);
        Question::factory()->create(["form_id" => 1, "field_id" => 21]);
        Question::factory()->create(["form_id" => 1, "field_id" => 22]);
        Question::factory()->create(["form_id" => 1, "field_id" => 23]);
        Question::factory()->create(["form_id" => 1, "field_id" => 24]);
        Question::factory()->create(["form_id" => 1, "field_id" => 25]);
        Question::factory()->create(["form_id" => 1, "field_id" => 26]);
        Question::factory()->create(["form_id" => 1, "field_id" => 27]);
        Question::factory()->create(["form_id" => 1, "field_id" => 28]);
        
        // WIP too...

        


    }
}
