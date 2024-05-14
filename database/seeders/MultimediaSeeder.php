<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//importo el modelo Multimedia
use App\Models\Multimedia;

class MultimediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Multimedia::factory(4)->create();

        //creo los datos que estarán siempre
        Multimedia::create([
            'name' => 'imagen1.jpg',
            'user_id' => 1,
            'moment_id' => 1,
        ]);
        Multimedia::create([
            'name' => 'imagen2.jpg',
            'user_id' => 1,
            'moment_id' => 1,
        ]);
        Multimedia::create([
            'name' => 'imagen3.jpg',
            'user_id' => 1,
            'moment_id' => 2,
        ]);
        Multimedia::create([
            'name' => 'imagen4.jpg',
            'user_id' => 1,
            'moment_id' => 2,
        ]);
        

    }
}
