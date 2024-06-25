<?php

namespace Database\Seeders;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $client = new Client([
            'base_uri' => 'https://picsum.photos',
            'timeout'  => 10.0,
        ]);
        foreach (range(1, 3) as $index) {
            // Generar nombre de archivo único para la imagen
            $filename = $faker->unique()->word . '.jpg'; // Puedes cambiar la extensión si prefieres

            // Obtener una imagen aleatoria de Lorem Picsum
            $response = $client->get('/640/480', ['stream' => true]);

            // Guardar la imagen en la carpeta pública (public/images)
            $publicPath = public_path('imagenes/' . $filename);
            File::put($publicPath, $response->getBody()->getContents());
            $imagePath = '/' . 'imagenes/' . $filename;

            $user = User::create([
                'ci'=>"".$faker->numberBetween(10000000,90000000),
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'gender' => $faker->randomElement(['M', 'F']),
                'birth_date' => $faker->date,
                'address' => $faker->address,
                'image' => $imagePath, // Ruta relativa al archivo de imagen
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('12345678'), // Contraseña predeterminada
            ]);

            Tutor::create([
                'id' => $user->id,
                'ocupacion' => $faker->firstName
            ]);
        }
    }
}
