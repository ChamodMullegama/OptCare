<?php

namespace Database\Seeders;

use App\Models\NonSurgicalTreatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NonSurgicalTreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         NonSurgicalTreatment::factory()->count(10)->create();
    }
}
