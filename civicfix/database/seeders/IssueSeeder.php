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
                    'title' => 'Large pothole on MG Road',
                    'description' => 'There is a large pothole on MG Road near the intersection with Brigade Road. It has damaged several cars.',
                    'category' => 'Roads',
                    'status' => 'pending',
                    'address' => 'MG Road, Bengaluru',
                    'latitude' => 12.9716,
                    'longitude' => 77.5946,
                ],
                [
                    'title' => 'Broken street light in Jayanagar',
                    'description' => 'Street light number 45 in Jayanagar 4th Block is not working. It has been dark for over a week.',
                    'category' => 'Lighting',
                    'status' => 'investigating',
                    'address' => 'Jayanagar 4th Block, Bengaluru',
                    'latitude' => 12.9279,
                    'longitude' => 77.5885,
                ],
                [
                    'title' => 'Overflowing garbage bin in Indiranagar',
                    'description' => 'The garbage bin at the corner of 100 Feet Road and CMH Road is overflowing with trash.',
                    'category' => 'Waste',
                    'status' => 'in_progress',
                    'address' => '100 Feet Road, Indiranagar, Bengaluru',
                    'latitude' => 12.9748,
                    'longitude' => 77.6384,
                ],
                [
                    'title' => 'Water leak in Koramangala',
                    'description' => 'There is a water leak coming from a fire hydrant on Koramangala 80 Feet Road.',
                    'category' => 'Water',
                    'status' => 'resolved',
                    'address' => 'Koramangala 80 Feet Road, Bengaluru',
                    'latitude' => 12.9352,
                    'longitude' => 77.6245,
                ],
            ];

            foreach ($issues as $issue) {
                $user->issues()->create($issue);
            }
        }
    }
}
