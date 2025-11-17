<?php 

namespace andeh\Framework\Domain\Models;
use andeh\Framework\Domain\Enums\UserRoleEnum;
use andeh\Framework\Domain\Enums\UserDepartmentEnum;
use andeh\Framework\Domain\Models\BaseUser;
class User extends BaseUser
{

    protected string $role = UserRoleEnum::USER->value;
    protected ?string $full_name = null;
    protected ?string $email = null;
    protected ?string $phone = null;
    protected ?string $avatar = null;

    function __construct(
        int | string $id,
        string $identifier,
        string $passwordHash,
        bool $is_active,
        string $role = UserRoleEnum::USER->value,
        ?string $full_name = null,
        ?string $email = null,
        ?string $phone = null,
        ?string $avatar = null,
        ?string $created_at = null,
        ?string $updated_at = null,
    )
    {
        parent::__construct(
            id: $id,
            identifier: $identifier,
            passwordHash: $passwordHash,
            is_active: $is_active,
            created_at: $created_at,
            updated_at: $updated_at,
        );
        $this->role = $role;
        $this->full_name = $full_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->avatar = $avatar;
    }
    public function getRole(): string{return $this->role;}
    public function getFullName(): ?string{return $this->full_name;}
    public function getEmail(): ?string{return $this->email;}
    public function getPhone(): ?string{return $this->phone;}
    public function getAvatar(): ?string{return $this->avatar;}

}
