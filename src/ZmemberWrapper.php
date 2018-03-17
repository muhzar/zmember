<?php

namespace Muhzar\Zmember;

class ZmemberWrapper 
{
    private $name;
    private $email;

    public function __construct($user)
    {
        $this->name = $user['name'];
        $this->email = $user['email'];
        // dd($user);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

}
