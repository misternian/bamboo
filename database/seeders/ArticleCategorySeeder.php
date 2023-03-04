<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('article_categories')->insert(
            [
                'name' => '默认分类',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
    }
}
