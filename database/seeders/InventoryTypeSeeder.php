<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inventory_types')->insert([
            [
                'name' => '可售库存',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => '退货',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => '损耗',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => '历史销售',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
