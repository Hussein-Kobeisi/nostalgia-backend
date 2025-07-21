<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CapsuleMedia;

class CapsuleMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        CapsuleMedia::factory(200)->create();
    }
}
