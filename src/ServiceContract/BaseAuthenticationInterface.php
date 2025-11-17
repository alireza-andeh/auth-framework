<?php 

namespace andeh\Framework\ServiceContract;

use andeh\Framework\ServiceContract\DTOContact\LoginDTOInterface;

interface BaseAuthenticationInterface
{
    public function login(LoginDTOInterface $dto):bool;
    public function logout():void;
    public function isAuthenticated():bool;
    
}

