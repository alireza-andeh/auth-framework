<?php

namespace andeh\Framework\Core;

use andeh\Framework\ServiceContract\BaseAuthenticationInterface;
use andeh\Framework\ServiceContract\DTOContact\LoginDTOInterface;
use andeh\Framework\ServiceContract\ResultsContract\AuthResultsInterface;
use andeh\Framework\ServiceContract\Enums\AuthMethod;
use andeh\Framework\Services\Results\AuthResult;
class AuthenticationManager
{
    private array $authProviders = [];


    public function __construct(array $authProviders= [])
    {
        foreach ($authProviders as $method => $authProvider)
            $this->register($method, $authProvider);

    }
    public function  register(AuthMethod|string $method, BaseAuthenticationInterface $authProvider): void
    {
        // get method from AuthEnum
        $key = $method instanceof  AuthMethod ? $method->value : $method;
        if (isset($this->authProviders[$key]))
        {
            throw new \InvalidArgumentException("Authentication  provider '$key' already exists.");
        }
        $this->authProviders[$key] = $authProvider;
    }
    public function  hasAuthProviders(AuthMethod|string $method): bool
    {
        $key = $method instanceof  AuthMethod ? $method->value : $method;
        return isset($this->authProviders[$key]);
    }

    /**
     * @return array
     */
    public function getAuthProvider(string|AuthMethod $method): ?BaseAuthenticationInterface
    {
        $key = $method instanceof  AuthMethod ? $method->value : $method;
        return $this->authProviders[$key]??null;
    }
    public function listMethods(): array
    {
        return array_keys($this->authProviders);
    }
    public  function login(string|AuthMethod $method ,LoginDTOInterface $loginDTO): AuthResultsInterface
    {
        $provider = $this->getAuthProvider($method);
        if(!$provider)
        {
            $key = $method instanceof  AuthMethod ? $method->value : $method;
            throw new \RuntimeException("Authentication  provider '$key' does not exists.");
        }
        return  $provider->login($loginDTO);

    }
    public  function logoutAll()
    {
        foreach ($this->authProviders as $provider){
            $provider->logout();
        }
    }
    public  function isAuthenticated(): bool
    {
        foreach ($this->authProviders as $provider){
            if($provider->isAuthenticated()){
                return true;
            }
        }
        return false;
    }
}