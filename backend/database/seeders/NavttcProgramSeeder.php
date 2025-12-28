<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavttcProgram;

class NavttcProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Amazon Virtual Assistant',
                'required_qualification' => 'Intermediate',
                'apply_link' => 'https://nsis.navttc.gov.pk/',
                'status' => 'active',
            ],
            [
                'title' => 'Digital Marketing & Search Engine Optimization (SEO)',
                'required_qualification' => 'Intermediate',
                'apply_link' => 'https://nsis.navttc.gov.pk/',
                'status' => 'active',
            ],
            [
                'title' => 'Graphic Design and Video Editing',
                'required_qualification' => 'Intermediate',
                'apply_link' => 'https://nsis.navttc.gov.pk/',
                'status' => 'active',
            ],
            [
                'title' => 'Microsoft Power BI',
                'required_qualification' => 'Bachelor in Commerce, Economics, Statistics, Banking, Finance, ACCA, CS, IT, Maths, ICMA inter, CA inter, PIPFA, BBA, AI/Fintech, Banking & Finance, Accounting & Finance, or Business Analytics',
                'apply_link' => 'https://nsis.navttc.gov.pk/',
                'status' => 'active',
            ],
            [
                'title' => 'Cyber Security (CEH)',
                'required_qualification' => 'Bachelor in IT, CS, Maths, Statistics, Economics, Physics or Engineering (or 5th semester enrolled)',
                'apply_link' => 'https://nsis.navttc.gov.pk/',
                'status' => 'active',
            ],
            [
                'title' => 'English Language (IELTS/PTE B1–B2 CEFR)',
                'required_qualification' => 'Matric OR 3 Months Vocational Certificate',
                'apply_link' => 'https://nsis.navttc.gov.pk/',
                'status' => 'active',
            ],
            [
                'title' => 'German Language A1',
                'required_qualification' => 'Matric OR 3 Months Vocational Certificate',
                'apply_link' => 'https://nsis.navttc.gov.pk/',
                'status' => 'active',
            ],
            [
                'title' => 'Professional Photography, Documentary Ad Making',
                'required_qualification' => 'Intermediate',
                'apply_link' => 'https://nsis.navttc.gov.pk/',
                'status' => 'active',
            ],
        ];

        foreach ($programs as $program) {
            NavttcProgram::updateOrCreate(
                ['title' => $program['title']],
                $program
            );
        }
    }
}
