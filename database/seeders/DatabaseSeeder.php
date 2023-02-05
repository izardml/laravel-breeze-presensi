<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        Classes::create(['name' => 'Guru']);
        Classes::create(['name' => '12 RPL 1']);
        Classes::create(['name' => '12 RPL 2']);

        Subject::create(['name' => 'Pemrograman Berorientasi Objek']);
        Subject::create(['name' => 'Pemrograman Dasar']);

        User::create([
            'email' => 'guru@gmail.com',
            'password' => Hash::make('123456'),
            'name' => 'Guru 1',
            'role' => 'guru',
            'class_id' => 1,
        ]);

        User::create([
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('123456'),
            'name' => 'Siswa 1',
            'role' => 'siswa',
            'class_id' => 2,
        ]);

        User::create([
            'email' => 'siswa2@gmail.com',
            'password' => Hash::make('123456'),
            'name' => 'Siswa 2',
            'role' => 'siswa',
            'class_id' => 3,
        ]);
    }
}
