<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
        $username = 'dr' . strtolower($firstName . $lastName);

        // Generate different availability patterns
        $availabilityPatterns = [
            // Full week schedule
            [
                'monday' => ['09:00-17:00'],
                'tuesday' => ['09:00-17:00'],
                'wednesday' => ['09:00-17:00'],
                'thursday' => ['09:00-17:00'],
                'friday' => ['09:00-17:00']
            ],
            // Early bird schedule
            [
                'monday' => ['07:00-15:00'],
                'tuesday' => ['07:00-15:00'],
                'wednesday' => ['07:00-15:00'],
                'thursday' => ['07:00-15:00'],
                'friday' => ['07:00-15:00']
            ],
            // Evening schedule
            [
                'monday' => ['12:00-20:00'],
                'tuesday' => ['12:00-20:00'],
                'wednesday' => ['12:00-20:00'],
                'thursday' => ['12:00-20:00'],
                'friday' => ['12:00-20:00']
            ],
            // Part-time schedule
            [
                'monday' => ['09:00-13:00'],
                'wednesday' => ['09:00-13:00'],
                'friday' => ['09:00-13:00']
            ],
            // Split shift schedule
            [
                'monday' => ['08:00-12:00', '14:00-18:00'],
                'tuesday' => ['08:00-12:00', '14:00-18:00'],
                'thursday' => ['08:00-12:00', '14:00-18:00'],
                'friday' => ['08:00-12:00', '14:00-18:00']
            ],
            // Weekend availability
            [
                'monday' => ['10:00-16:00'],
                'tuesday' => ['10:00-16:00'],
                'saturday' => ['09:00-15:00'],
                'sunday' => ['09:00-15:00']
            ],
            // Extended hours
            [
                'monday' => ['08:00-18:00'],
                'tuesday' => ['08:00-18:00'],
                'wednesday' => ['08:00-18:00'],
                'thursday' => ['08:00-18:00']
            ],
            // Flexible schedule
            [
                'tuesday' => ['10:00-14:00'],
                'wednesday' => ['14:00-18:00'],
                'thursday' => ['09:00-17:00'],
                'friday' => ['08:00-16:00']
            ],
            // Compact schedule
            [
                'monday' => ['09:00-15:00'],
                'tuesday' => ['09:00-15:00'],
                'wednesday' => ['09:00-15:00'],
                'thursday' => ['09:00-15:00'],
                'friday' => ['09:00-15:00']
            ],
            // Specialty clinic schedule
            [
                'monday' => ['11:00-19:00'],
                'wednesday' => ['11:00-19:00'],
                'friday' => ['11:00-19:00'],
                'saturday' => ['10:00-16:00']
            ]
        ];

        static $counter = 0;
        $availability = $availabilityPatterns[$counter % count($availabilityPatterns)];
        $counter++;

        return [
            'doctorId' => 'DOC' . str_pad($this->faker->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'age' => $this->faker->numberBetween(28, 65),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'email' => strtolower($firstName . '.' . $lastName . '@optcare.com'),
            'mobile_number' => $this->faker->phoneNumber(),
            'marital_status' => $this->faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
            'qualification' => $this->faker->randomElement([
                'MBBS, MD Ophthalmology',
                'MBBS, MS Ophthalmology',
                'MBBS, DNB Ophthalmology',
                'MBBS, MD, Fellowship in Retina',
                'MBBS, MS, Fellowship in Cornea',
                'MBBS, MD, Fellowship in Glaucoma',
                'MBBS, MS, Fellowship in Pediatric Ophthalmology'
            ]),
            'designation' => $this->faker->randomElement([
                'Senior Ophthalmologist',
                'Consultant Ophthalmologist',
                'Retina Specialist',
                'Cornea Specialist',
                'Glaucoma Specialist',
                'Pediatric Ophthalmologist',
                'Oculoplastic Surgeon'
            ]),
            'blood_group' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'address' => $this->faker->streetAddress(),
            'country' => $this->faker->country(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'profile_image' => 'default.jpg',
            'bio' => $this->faker->paragraph(3),
            'availability' => json_encode($availability),
            'username' => $username,
            'password' => Hash::make('password123')
        ];
    }
}
