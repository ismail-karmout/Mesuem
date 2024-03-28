<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user one one to one relationship with artist
        $name = fake()->name();
        $email = fake()->unique()->safeEmail();
        $phone = fake()->phoneNumber();
        $bio = fake()->text();
        $genre = fake()->randomElement([
            'pop', 'rock', 'jazz', 'blues', 'country', 'reggae', 'hip-hop', 'r&b', 'soul', 'funk', 'disco',
            'classical', 'electronic', 'folk', 'indie', 'metal', 'punk', 'techno', 'world'
        ]);
        $location = fake()->city();
        $user = User::factory()->create([
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //enum role
            'role' => 'artist',
            'remember_token' => Str::random(10),
        ]);
        $user->artist()->create([
            'phone' => $phone,
            'bio' => $bio,
            'genre' => $genre,
            'location' => $location,
        ]);
        $user->save();
    }
}
