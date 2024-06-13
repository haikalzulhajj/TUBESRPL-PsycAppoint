<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    function rrmdir($dir)
    {
      if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
          if ($object != "." && $object != "..") {
            if (filetype($dir . "/" . $object) == "dir")
              rrmdir($dir . "/" . $object);
            else unlink($dir . "/" . $object);
          }
        }
        reset($objects);
        rmdir($dir);
      }
    };

    rrmdir('./storage/app/public/');

    User::factory(7)->create();

    User::factory()->create([
      'id' => '01j01ffsbgmmxh5r1qtte1dk81',
      'name' => fake()->name(),
      'email' => 'root@laravel.dev',
      'avatar' => 'https://gravatar.com/avatar/' . hash('sha256', 'root@laravel.dev'),
      'phone_number' => '628' . fake()->numerify('##########'),
      'address' => fake()->address(),
      'role' => 'root',
      'service' => 'none',
      'email_verified_at' => now(),
      'password' => Hash::make('password'),
      'remember_token' => Str::random(10)
    ]);

    User::factory()->create([
      'id' => '01j01fq677da58dn8rmn23t149',
      'name' => fake()->name(),
      'email' => 'admin@laravel.dev',
      'avatar' => 'https://gravatar.com/avatar/' . hash('sha256', 'admin@laravel.dev'),
      'phone_number' => '628' . fake()->numerify('##########'),
      'address' => fake()->address(),
      'role' => 'admin',
      'service' => 'none',
      'email_verified_at' => now(),
      'password' => Hash::make('password'),
      'remember_token' => Str::random(10)
    ]);

    User::factory()->create([
      'id' => '01j01fq673cegzgzbcna1jt1c5',
      'name' => fake()->name(),
      'email' => 'user@laravel.dev',
      'avatar' => 'https://gravatar.com/avatar/' . hash('sha256', 'user@laravel.dev'),
      'phone_number' => '628' . fake()->numerify('##########'),
      'address' => fake()->address(),
      'role' => 'user',
      'service' => 'none',
      'email_verified_at' => now(),
      'password' => Hash::make('password'),
      'remember_token' => Str::random(10)
    ]);
  }
}
