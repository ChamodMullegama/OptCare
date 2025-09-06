<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     Doctor::create([
    //         'doctorId' => 'DOC001',
    //         'first_name' => 'John',
    //         'last_name' => 'Smith',
    //         'age' => 35,
    //         'gender' => 'Male',
    //         'email' => 'doctor@optcare.com',
    //         'mobile_number' => '1234567890',
    //         'marital_status' => 'Married',
    //         'qualification' => 'MBBS, MD',
    //         'designation' => 'Senior Ophthalmologist',
    //         'blood_group' => 'O+',
    //         'address' => '123 Medical Street',
    //         'country' => 'USA',
    //         'state' => 'California',
    //         'city' => 'Los Angeles',
    //         'postal_code' => '90001',
    //         'profile_image' => 'default.jpg',
    //         'bio' => 'Experienced ophthalmologist with expertise in general eye care.',
    //         'availability' => json_encode([
    //             'monday' => ['09:00-17:00'],
    //             'tuesday' => ['09:00-17:00'],
    //             'wednesday' => ['09:00-17:00'],
    //             'thursday' => ['09:00-17:00'],
    //             'friday' => ['09:00-17:00']
    //         ]),
    //         'username' => 'drjohnsmith',
    //         'password' => Hash::make('password')
    //     ]);
    // }

    public function run(): void
    {
        Doctor::factory(10)->create();
    }
}
