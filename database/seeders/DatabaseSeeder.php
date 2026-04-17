<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Default login user
        $testUser = User::factory()->create([
            'name' => 'Student Dev',
            'email' => 'dev@student.com',
            'password' => bcrypt('password'),
        ]);

        // Generate team members
        $team = User::factory(4)->create();
        $team->push($testUser);

        // Generate tickets assigned to random teammates
        Ticket::factory(12)->recycle($team)->create()->each(function ($ticket) use ($team) {
            // Add random comments to some tickets
            if (rand(0, 1)) {
                Comment::factory(rand(1, 4))->create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $team->random()->id,
                ]);
            }
        });
    }
}
