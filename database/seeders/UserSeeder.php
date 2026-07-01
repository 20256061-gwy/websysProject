<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@clinic.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);
    
        // Doctor 1
        $doctor1 = \App\Models\User::create([
            'name' => 'Dr. Juan dela Cruz',
            'email' => 'juan@clinic.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'doctor',
        ]);
    
        $doctor1->doctor()->create([
            'specialization' => 'General Physician',
            'contact_number' => '09171234567',
        ]);
    
        // Doctor 2
        $doctor2 = \App\Models\User::create([
            'name' => 'Dr. Maria Santos',
            'email' => 'maria@clinic.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'doctor',
        ]);
    
        $doctor2->doctor()->create([
            'specialization' => 'Pediatrician',
            'contact_number' => '09187654321',
        ]);
    }
}
