<?php

namespace Database\Seeders;

use Database\Factories\ViewAbleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewAbleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('viewables')->insert(ViewableFactory::new()->definition());
        }
    }
}
