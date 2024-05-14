<?php

namespace Database\Seeders;

use App\Models\Moment;
//importo el modelo Moment
use Illuminate\Database\Seeder;

class MomentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Moment::create([
            'name' => 'Bautizo Lluna',
            'description' => 'Bautizo de Lluna en la iglesia de Sant Joan',
            'user_id' => 1,
        ]);
        Moment::create([
            'name' => 'Sevilla 2022',
            'description' => 'Viaje de las señoras a Sevilla',
            'user_id' => 1,
        ]);
        Moment::create([
            'name' => 'Boda de Juan y Carla',
            'description' => 'Boda de Juan y Carla en el restaurante El Celler',
            'user_id' => 2,
        ]);
        Moment::create([
            'name' => 'Boda deAna y amalia',
            'description' => 'Boda de Juan y Carla en el restaurante El cetro',
            'user_id' => 3,
        ]);
        Moment::create([
            'name' => 'Cumpleaños',
            'description' => 'Cumpleaños de Alba y Maria en el restaurante El cetro',
            'user_id' => 5,
        ]);
        Moment::create([
            'name' => 'Anastasia en la piscina',
            'description' => 'Momento de fotos',
            'user_id' => 4,
        ]);
    }
}
