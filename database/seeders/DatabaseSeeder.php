<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      //   \App\Models\User::factory(5)->create();

$user = User::factory()->create([
   'name' => 'Billy Boy',
   'email'=> 'billy@gmail.com']);

Listing::factory(6)->create([
   'user_id' => $user->id
]);

    
    } 
}
