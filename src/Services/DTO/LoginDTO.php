<?php 


namespace andeh\Framework\Services\DTO;



class LoginDTO{
    public string $username;
    public string $password;
    public bool $remember_me = false;

    public function __construct(string $username, string $password, bool $remember_me = false)
    {
        $this->username = $username;
        $this->password = $password;
        $this->remember_me = $remember_me;
    }
}