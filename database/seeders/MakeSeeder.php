<?php

namespace Database\Seeders;

use App\Models\Make;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Make::factory(8)->create();
    }
}
