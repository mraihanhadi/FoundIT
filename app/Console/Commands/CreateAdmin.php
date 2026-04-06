<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

#[Signature('app:create-admin')]
#[Description('Create an administrator user securely from the command line')]
class CreateAdmin extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter admin name');
        
        if (!$name) {
            $this->error('Name is required.');
            return 1;
        }

        $email = $this->ask('Enter admin email');

        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            $this->error('Error: ' . $validator->errors()->first('email'));
            return 1;
        }

        $password = $this->secret('Enter admin password');
        $confirmPassword = $this->secret('Confirm admin password');

        if ($password !== $confirmPassword) {
            $this->error('Passwords do not match!');
            return 1;
        }

        if (strlen($password) < 8) {
            $this->error('Password must be at least 8 characters!');
            return 1;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);

        $this->info("Admin user '{$user->name}' created successfully!");
        
        return 0;
    }
}
