<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            ArticleCategorySeeder::class,
            CompanySeeder::class,
            ProductCategorySeeder::class,
            InventoryTypeSeeder::class,
            ProductPropertySeeder::class,
            ProductTypeSeeder::class,
            OrderTypeSeeder::class,
            ClientSeeder::class,
            SiteSeeder::class,
            ClientTypeSeeder::class,
        ]);
    }
}

