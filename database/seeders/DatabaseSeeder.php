<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\SolicitudeStatus;
use App\Enums\TypesQuestion;
use App\Models\Answer;
use App\Models\Field;
use App\Models\Form;
use App\Models\Period;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Solicitude;
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
            "email" => "bruno@gmail.com",
            "username" => "Bruno Hernandez",
            "is_admin" => true,
            "is_support" => true
        ]);

        $user2 = User::factory()->create([
            "email" => "jesus@gmail.com",
            "username" => "Jesus Flores",
            "is_admin" => true,
            "is_support" => true
        ]);

        $user3 = User::factory()->create([
            "email" => "jorge@gmail.com",
            "username" => "Jorge Davalos",
            "is_admin" => true,
            "is_support" => true
        ]);

        $user4 = User::factory()->create([
            "email" => "delia@gmail.com",
            "username" => "Delia",
            "is_admin" => true,
            "is_support" => false
        ]);

        $user5 = User::factory()->create([
            "email" => "user@gmail.com",
            "username" => "Bonifacio Mesa",
            "is_admin" => false,
            "is_support" => false
        ]);

        //------------------------------------ fields

        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "nombre", "frontend_name" => "Nombre"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "curp", "frontend_name" => "CURP"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "paterno", "frontend_name" => "Paterno"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "materno", "frontend_name" => "Materno"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "correo", "frontend_name" => "Correo"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "celular", "frontend_name" => "Celular"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "telefono", "frontend_name" => "Teléfono"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "calle", "frontend_name" => "Calle"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "exterior", "frontend_name" => "Exterior"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "interior", "frontend_name" => "Interior"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "colonia", "frontend_name" => "Colonia"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "cp", "frontend_name" => "CP"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "municipio", "frontend_name" => "Municipio"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "estados_id", "frontend_name" => "Estado"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "telefono_fam", "frontend_name" => "Teléfono Familiar"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "estadocivil", "frontend_name" => "Estado Civil"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "sexo", "frontend_name" => "Sexo"]);
        Field::factory()->create(["type" => TypesQuestion::DATETIME, "backend_name" => "fecha_nacimiento", "frontend_name" => "Fecha Nacimiento"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "nacionalidad", "frontend_name" => "Nacionalidad"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "pais_nacimiento", "frontend_name" => "País de Nacimiento"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "edo_nacimiento", "frontend_name" => "Estado de Nacimiento"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "mpio_nacimiento", "frontend_name" => "Municipio de Nacimiento"]);
        Field::factory()->create(["type" => TypesQuestion::INT, "backend_name" => "num_hermanos", "frontend_name" => "Número de hermanos"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "lugar_hermanos", "frontend_name" => "Lugar que ocupa de hermano"]);
        Field::factory()->create(["type" => TypesQuestion::BOOLEAN, "backend_name" => "tiene_hermano", "frontend_name" => "Tiene hermanos?"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "aspirantes_hermanos_ceti_id", "frontend_name" => "Aspirantes hermanos CETI???"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "aspirantes_catmedios_id", "frontend_name" => "Aspirantes CATMEDIOS???"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "otro_nivel", "frontend_name" => "Otro nivel???"]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "entero_otro", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::BOOLEAN, "backend_name" => "trabaja", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "trabaja_puesto", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "trabaja_empresa", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "trabaja_tel", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "trabaja_turno_id", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "trabaja_antiguedad", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "trabaja_horario", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "nom_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "dom_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "col_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "tel_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "ocup_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "teltrab_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "cel_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "mismo_dom_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "finado_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "horario_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "sueldo_padre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "nom_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "dom_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "col_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "tel_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "ocup_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "teltrab_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "cel_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "mismo_dom_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "finado_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "horario_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "sueldo_madre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "tipo_sangre", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "enf_cronica", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "especifica_cronica", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "enf_alergia", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "especifica_alergia", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "enf_diferente", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "especifica_diferente", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "enf_protesis", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "especifica_protesis", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "nivel", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "escuela", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "mpio", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "estados_id", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "tipo", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "tipo_especificar", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "axo_al", "frontend_name" => ""]);
        Field::factory()->create(["type" => TypesQuestion::STRING, "backend_name" => "axo_del", "frontend_name" => ""]);

        //------------------------------------ forms

        $form1 = Form::factory()->create([
            "scholar_course" => "Propedéutico",
            "scholar_level" => "Tecnólogo",
            "label" => "2023A",
        ]);

        $form2 = Form::factory()->create([
            "scholar_course" => "Propedéutico",
            "scholar_level" => "Ingeniería",
            "label" => "2023A",
        ]);

        $form3 = Form::factory()->create([
            "scholar_course" => "Nivelación",
            "scholar_level" => "Tecnólogo",
            "label" => "2023A",
        ]);

        $form4 = Form::factory()->create([
            "scholar_course" => "Nivelación",
            "scholar_level" => "Ingeniería",
            "label" => "2023A",
        ]);

        //------------------------------------ questions

        for($i = 1; $i < 74; $i++) {
            Question::factory()->create(["form_id" => $form1->id, "field_id" => $i]);
        }

        for($i = 1; $i < 74; $i++) {
            Question::factory()->create(["form_id" => $form2->id, "field_id" => $i]);
        }

        for($i = 1; $i < 74; $i++) {
            Question::factory()->create(["form_id" => $form3->id, "field_id" => $i]);
        }

        for($i = 1; $i < 74; $i++) {
            Question::factory()->create(["form_id" => $form4->id, "field_id" => $i]);
        }

        //------------------------------------ periods

        $period1 = Period::create([
            "start_date" => date_format(date_create('2023-02-15'), 'Y-m-d'),
            "end_date" => date_format(date_create('2023-07-15'), 'Y-m-d'),
            "label" => "TECNOLOGO_PROPEDEUTICO_2023A"
        ]);

        $period2 = Period::create([
            "start_date" => date_format(date_create('2023-02-9'), 'Y-m-d'),
            "end_date" => date_format(date_create('2023-07-9'), 'Y-m-d'),
            "label" => "INGENIERIA_PROPEDEUTICO_2023A"
        ]);

        $period3 = Period::create([
            "start_date" => date_format(date_create('2023-08-10'), 'Y-m-d'),
            "end_date" => date_format(date_create('2023-12-10'), 'Y-m-d'),
            "label" => "TECNOLOGO_NIVELACION_2023"
        ]);

        $period4 = Period::create([
            "start_date" => date_format(date_create('2023-08-7'), 'Y-m-d'),
            "end_date" => date_format(date_create('2023-12-7'), 'Y-m-d'),
            "label" => "INGENIERIA_NIVELACION_2023"
        ]);

        Period::create([
            "start_date" => date_format(date_create('2023-08-12'), 'Y-m-d'),
            "end_date" => date_format(date_create('2023-12-12'), 'Y-m-d'),
            "label" => "TECNOLOGO_PROPEDEUTICO_2023B"
        ]);

        Period::create([
            "start_date" => date_format(date_create('2023-08-2'), 'Y-m-d'),
            "end_date" => date_format(date_create('2023-12-2'), 'Y-m-d'),
            "label" => "INGENIERIA_PROPEDEUTICO_2023B"
        ]);

        Period::create([
            "start_date" => date_format(date_create('2024-02-8'), 'Y-m-d'),
            "end_date" => date_format(date_create('2024-07-8'), 'Y-m-d'),
            "label" => "TECNOLOGO_PROPEDEUTICO_2024A"
        ]);

        Period::create([
            "start_date" => date_format(date_create('2024-02-11'), 'Y-m-d'),
            "end_date" => date_format(date_create('2024-07-11'), 'Y-m-d'),
            "label" => "INGENIERIA_PROPEDEUTICO_2024A"
        ]);

        Period::create([
            "start_date" => date_format(date_create('2024-08-22'), 'Y-m-d'),
            "end_date" => date_format(date_create('2024-12-22'), 'Y-m-d'),
            "label" => "TECNOLOGO_NIVELACION_2024"
        ]);

        Period::create([
            "start_date" => date_format(date_create('2024-08-17'), 'Y-m-d'),
            "end_date" => date_format(date_create('2024-12-17'), 'Y-m-d'),
            "label" => "INGENIERIA_NIVELACION_2024"
        ]);

        Period::create([
            "start_date" => date_format(date_create('2024-08-3'), 'Y-m-d'),
            "end_date" => date_format(date_create('2024-12-3'), 'Y-m-d'),
            "label" => "TECNOLOGO_PROPEDEUTICO_2024B"
        ]);

        Period::create([
            "start_date" => date_format(date_create('2024-08-5'), 'Y-m-d'),
            "end_date" => date_format(date_create('2024-12-5'), 'Y-m-d'),
            "label" => "INGENIERIA_PROPEDEUTICO_2024B"
        ]);

        //------------------------------------ settings

        Setting::create(["key" => "PERIODS.TECNOLOGO_PROPEDEUTICO.ACTIVE_ID_PERIOD", "value" => $period1->id,
            "description" => "El periodo actual del curso Tecnólogo-Propedéutico"]);
        Setting::create(["key" => "PERIODS.INGENIERIA_PROPEDEUTICO.ACTIVE_ID_PERIOD", "value" => $period2->id,
            "description" => "El periodo actual del curso Ingeniería-Propedéutico"]);

        Setting::create(["key" => "PERIODS.TECNOLOGO_NIVELACION.ACTIVE_ID_PERIOD", "value" => $period3->id, 
            "description" => "El periodo actual del curso Tecnólogo-Nivelación"]);
        Setting::create(["key" => "PERIODS.INGENIERIA_NIVELACION.ACTIVE_ID_PERIOD", "value" => $period4->id,
            "description" => "El periodo actual del curso Ingeniería-Nivelación"]);

        //------------------------------------ form

        $solicitude1 = Solicitude::create(["user_id" => $user1->id, "form_id" => $form1->id, "period_id" => $period1->id, 
            "status" => SolicitudeStatus::NEW]);

        $solicitude2  =Solicitude::create(["user_id" => $user1->id, "form_id" => $form2->id, "period_id" => $period2->id, 
            "status" => SolicitudeStatus::REJECTED]);

        $solicitude3 = Solicitude::create(["user_id" => $user2->id, "form_id" => $form2->id, "period_id" => $period2->id, 
            "status" => SolicitudeStatus::NEW]);
        
        Solicitude::create(["user_id" => $user2->id, "form_id" => $form3->id, "period_id" => $period3->id, 
            "status" => SolicitudeStatus::COMPLETED]);

        Solicitude::create(["user_id" => $user3->id, "form_id" => $form3->id, "period_id" => $period3->id, 
            "status" => SolicitudeStatus::NEW]);

        Solicitude::create(["user_id" => $user5->id, "form_id" => $form1->id, "period_id" => $period1->id, 
            "status" => SolicitudeStatus::NEW]);

        Solicitude::create(["user_id" => $user5->id, "form_id" => $form2->id, "period_id" => $period2->id, 
            "status" => SolicitudeStatus::ACCEPTED]);

        Solicitude::create(["user_id" => $user5->id, "form_id" => $form3->id, "period_id" => $period3->id, 
            "status" => SolicitudeStatus::NEW]);
        
        Solicitude::create(["user_id" => $user5->id, "form_id" => $form4->id, "period_id" => $period4->id, 
            "status" => SolicitudeStatus::COMPLETED]);

        //------------------------------------ answers

        // for solicitude1

        for($i = 1; $i < 74; $i++) {
            $answer = Answer::factory()->create(["question_id" => $i, "solicitude_id" => $solicitude1->id, "value" => ""]);
            $answer->value = get_data_regarding_type($answer->question->field->type);
            $answer->save();
        }

        // for solicitude2

        for($i = 74; $i < 148; $i++) {
            $answer = Answer::factory()->create(["question_id" => $i, "solicitude_id" => $solicitude2->id, "value" => ""]);
            $answer->value = get_data_regarding_type($answer->question->field->type);
            $answer->save();
        }

        // for solicitude3

        for($i = 74; $i < 148; $i++) {
            $answer = Answer::factory()->create(["question_id" => $i, "solicitude_id" => $solicitude3->id, "value" => ""]);
            $answer->value = get_data_regarding_type($answer->question->field->type);
            $answer->save();
        }

    }
}
