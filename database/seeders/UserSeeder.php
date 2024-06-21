<?php

namespace Database\Seeders;

use App\Models\Profesor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Christian Celso',
            'lastname' => 'Mamani Soliz',
            'gender' => 'M',
            'birth_date' => '2000-01-04',
            'address' => 'Santa Cruz',
            'image' => 'https://ddcoey7kqdip9.cloudfront.net/uploads/2020/08/Laravel-big.png',
            'email' => 'christian@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $profesor = new Profesor([
            'biografia' => 'Tengo 20 años de experiencia como profesor de violín',
            'estudios' => 'UAGRM'
        ]);
        $user->profesor()->save($profesor);
    }
}
