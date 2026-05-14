<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:make-admin {email}')]
#[Description('Make a user an admin by email address')]
class MakeAdmin extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User not found with email: {$email}");
            return;
        }
        
        $user->is_admin = true;
        $user->save();
        
        $this->info("Successfully made {$user->name} ({$user->email}) an admin!");
    }
}
