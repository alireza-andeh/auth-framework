<?php 

namespace andeh\Framework\Services;

use andeh\Framework\ServiceContract\AuthServiceInterface;
use andeh\Framework\Services\DTO\LoginDTO;
use andeh\Framework\Infrastructure\Contract\Repositories\UserRepositoryInterface;
use andeh\Framework\Utilities\PasswordManager;
use andeh\Framework\Domain\Contracts\BaseUserModelInterface;
use UserRoleEnum;

class AuthService {#implements AuthServiceInterface{
   
    private UserRepositoryInterface $repo;
    private PasswordManager $passwordManager;
    public function __construct(UserRepositoryInterface  $repo,PasswordManager $passwordManager) {
        $this->repo = $repo;
        $this->passwordManager = $passwordManager;
        if(session_status()=== PHP_SESSION_NONE) session_start();
    }
    public function login(LoginDTO $dto ,$user ,string $password):bool
    {
        $use = $this->repo->findByUserName($dto->username);
        if (!$user instanceof BaseUserModelInterface) return false;

        if(!$this->passwordManager->verify_password($dto->password,$user->getPassword()))
            return false;
        
        
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['user_role'] =  UserRoleEnum::USER->value;
        if($dto->remember_me ?? false)
        {
            setcookie('remember_token',bin2hex(random_bytes(32)),
          [
            'expires'=> time() + (86400*30),
            'path'=>'/',
            'httponly'=> true,
            'samesite'=>true,
          ]);
        }
        return true;
    }
    public function logout():void
    {
        session_start();
        session_unset();
        session_destroy();

        if(isset($_COOKIE['remember_token'])){
            setcookie('remember_token','',time()-3600,'/');
        }
    }

    public function isAuthenticated():bool
    {
        return isset($_SESSION['user_id']);
    }

}