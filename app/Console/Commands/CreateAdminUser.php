<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {--email=admin@borneojaya.test} {--password=root} {--name=Admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');
        $name = $this->option('name');

        // Check if user already exists
        if (User::where('email', $email)->exists()) {
            $this->warn("User with email {$email} already exists!");
            if (!$this->confirm('Do you want to update the password?', false)) {
                return 0;
            }
            
            $user = User::where('email', $email)->first();
            $user->update([
                'password' => Hash::make($password),
                'role' => 'admin',
            ]);
            $this->info("Admin user password updated successfully!");
            return 0;
        }

        // Create new admin user
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info("Admin user created successfully!");
        $this->line("Email: {$email}");
        $this->line("Password: {$password}");
        
        return 0;
    }
}
