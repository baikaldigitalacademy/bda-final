<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Summary;

class SummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "owner_id" => 4,
                "name" => "Елизаров Владислав Евгеньевич",
                "email" => "tornado_er@mail.ru",
                "position_id" => 1,
                "level_id" => 2,
                "date" => "2021-10-20",
                "status_id" => 1,
                "skills" => "<p>ООП</p><p>PHP</p><p>Laravel</p><p>SQL</p><p>Git</p><p><br></p><p>C++</p><p>Python</p><p>Kotlin</p>",
                "description" => '<p>Образование: бакалавриат, профиль "Математическое и компьютерное моделирование"</p><p>Работа в проектах: "CRM for HR" (<a href="https://bda-team.fvds.ru" target="_blank">bda-team.fvds.ru</a>) - <a href="https://github.com/baikaldigitalacademy/bda-final" target="_blank">github.com/baikaldigitalacademy/bda-final</a>.</p><p>Профиль гитхаб: <a href="https://github.com/Salriel" target="_blank">github.com/Salriel</a></p>',
                "experience" => "Отсутствует"
            ],
            [
                "owner_id" => 5,
                "name" => "Рамизова Карина Бахадуровна",
                "email" => "karinablah767@gmail.com",
                "position_id" => 1,
                "date" => "2021-10-20",
                "status_id" => 1,
                "skills" => "<p>Php, C++, Java, Python, Haskell, JavaScript</p>",
                "description" => '<p>Образование: ИГУ ИМИТ 3курс Фундаментальная информатика и информационные технологии</p>',
                "experience" => "Отсутствует"
            ],
            [
                "owner_id" => 6,
                "name" => "Бучнев Вячеслав Станиславович",
                "email" => "slavabuchnev5@gmail.com",
                "position_id" => 1,
                "level_id" => 2,
                "date" => "2021-10-20",
                "status_id" => 1,
                "skills" => "<p>PHP</p><p>MySQL</p><p>Git</p>",
                "description" => '<p>В данный момент учусь в 11 классе, направление:"Технологическое"</p><p>ссылка на github:<a href="https:// https://github.com/Slava55555" target="_blank"> https://github.com/Slava55555</a></p><p>командная работа:<a href="https://github.com/baikaldigitalacademy/bda-final" target="_blank">https://github.com/baikaldigitalacademy/bda-final</a></p>',
                "experience" => "Отсутствует"
            ],
            [
                "owner_id" => 3,
                "name" => "Ильюшин Александр",
                "email" => "frozo02@yandex.ru",
                "position_id" => 1,
                "date" => "2021-10-20",
                "status_id" => 2,
                "skills" => "<p>N/A</p>",
                "description" => '<p>N/A</p>',
                "experience" => "<p>N/A</p>"
            ]
        ];

        foreach( $data as $summary ){
            ( new Summary() )->fill( $summary )->save();
        }

        Summary::factory( 96 )->create();
    }
}
