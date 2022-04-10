<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create new user with hashed password and save it to database
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function createNewUser(string $name, string $email, string $password) : User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => $this->makeHashedPassword($password)
        ]);
    }

    /**
     * Make hash from user password
     *
     * @param string $password
     * @return string
     */
    private function makeHashedPassword(string $password) : string
    {
        return Hash::make($password);
    }
}
