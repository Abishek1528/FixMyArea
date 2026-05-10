<?php

namespace Database\Seeders;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        
        if ($user) {
            $issues = [
                [
                    'title' => 'Large pothole on Main Street',
                    'description' => 'There is a large pothole on Main Street near the intersection with Oak Avenue. It has damaged several cars.',
                    'category' => 'Roads',
                    'status' => 'pending',
                    'address' => '123 Main St, Springfield',
                ],
                [
                    'title' => 'Broken street light on Park Ave',
                    'description' => 'Street light number 45 on Park Avenue is not working. It has been dark for over a week.',
                    'category' => 'Lighting',
                    'status' => 'investigating',
                    'address' => '45 Park Ave, Springfield',
                ],
                [
                    'title' => 'Overflowing garbage bin',
                    'description' => 'The garbage bin at the corner of Market and 3rd is overflowing with trash.',
                    'category' => 'Waste',
                    'status' => 'in_progress',
                    'address' => 'Market & 3rd St, Springfield',
                ],
                [
                    'title' => 'Water leak on 5th Street',
                    'description' => 'There is a water leak coming from a fire hydrant on 5th Street.',
                    'category' => 'Water',
                    'status' => 'resolved',
                    'address' => '789 5th St, Springfield',
                ],
            ];

            foreach ($issues as $issue) {
                $user->issues()->create($issue);
            }
        }
    }
}
