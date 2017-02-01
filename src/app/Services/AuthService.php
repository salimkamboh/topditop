<?php

namespace App\Services;

use App\User;

class AuthService
{

    /**
     * TODO: send mail to administrator
     *
     * @param $email
     * @param $password
     * @return User
     */
    public function createAdmin($email, $password)
    {
        $user = new User();
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->admin = true;
        $user->save();

        return $user;
    }
}