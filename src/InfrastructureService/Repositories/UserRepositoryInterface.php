<?php 

namespace andeh\Framework\Infrastructure\Contract\Repositories;

use andeh\Framework\Domain\Enums\UserRoleEnum;
use andeh\Framework\Domain\Enums\UserDepartmentEnum;
use andeh\Framework\Domain\Contracts\BaseUserModelInterface;

interface UserRepositoryInterface extends BaseUserRepositoryInteface {
    public function getActiveUsers():array;
    public function getInactiveUsers():array;
    public function getUsersByRole(UserRoleEnum $role):array;
    public function findByPhone(string $username):?BaseUserModelInterface;
    public function phoneExists(string $phone):bool;
    public function emailExists(string $email):bool;
}