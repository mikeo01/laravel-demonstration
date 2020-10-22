<?php

namespace App\Models\Managers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class UserManager
{
    /**
     * Validate against user
     *
     * @param string $email
     * @param string $password
     * @param User|null $user
     * @return bool
     */
    public function validate(string $email, string $password, ?User $user): bool
    {
        return $user
            ? ($email === $user->email && Hash::make($password) === $user->password)
            : Auth::validate(['email' => $email, 'password' => $password]);
    }

    /**
     * Attempt login
     *
     * @param string $email
     * @param string $password
     * @param User|null $user
     * @return bool
     */
    public function login(string $email, string $password): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }
}
