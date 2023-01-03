<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@admin.com',
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'member',
        //     'email' => 'member@admin.com',
        // ]);

        // \App\Models\Product::factory(10)->create();
        \App\Models\Category::factory(10)->create();
    }
}
