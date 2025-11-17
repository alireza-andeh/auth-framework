<?php

namespace andeh\Framework\Infrastructure\Repositories;


use andeh\Framework\Domain\Contracts\BaseUserModelInterface;
use andeh\Framework\Domain\Models\User;
use andeh\Framework\Domain\Enums\UserRoleEnum;
use andeh\Framework\Infrastructure\Contract\Repositories\UserRepositoryInterface;
use PDO;

class UserRepository implements  UserRepositoryInterface
{

    public function __construct(private  PDO $db){}
    public  function  mapToUser(array $row):BaseUserModelInterface
    {
        return new User(
            id : $row["id"],
            identifier: $row["identifier"],
            passwordHash: $row["password"],
            is_active: $row["is_active"],
            role: $row["role"]?? UserRoleEnum::USER,
            full_name: $row["full_name"]??null,
            email: $row["email"]??null,
            phone: $row["phone"]??null,
            avatar: $row["avatar"]??null,
            created_at: $row["created_at"],
            updated_at: $row["updated_at"],
        );
    }
    public function create(BaseUserModelInterface $user):bool
    {
        $query = <<<MySQL_QUERY
            INSERT INTO users (username, email, password, full_name, department, phone, role,is_active)
            VALUES (:username, :email, :password, :full_name, :department, :phone, :role,:is_active)
        MySQL_QUERY;        

        $params = [
        ':username'   => $user->username,
        ':email'      => $user->email,
        ':password'   => hash_password($user->password),
        ':full_name'  => $user->full_name,
        ':department' => $user->department,
        ':phone'      => $user->phone,
        ':role'       => $user->role ?? UserRoleEnum::USER->value,
        ':is_active'  => false,
        ];
       
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);

    }
    public function get_by_username(string $username)
    {
        
        $query = "SELECT * FROM users WHERE (username = :username OR email = :username) AND is_active = 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user;
    }
    public function user_exists(string $username,string $email):bool
    {
        $query  = "SELECT * FROM users WHERE username = :username OR email = :email";
        $stmt   = $this->db->prepare($query); 
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function findById(int|string $id): ?BaseUserModelInterface
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return  $row ? $this->mapToUser($row) : null;
    }

    public function findByIdentifier(string $identifier): ?BaseUserModelInterface
    {
        // TODO: Implement findByIdentifier() method.
    }

    public function existsByIdentifier(string $identifier): bool
    {
        // TODO: Implement existsByIdentifier() method.
    }

    public function update(BaseUserModelInterface $user): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int|string $id): bool
    {
        // TODO: Implement delete() method.
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function getActiveUsers(): array
    {
        // TODO: Implement getActiveUsers() method.
    }

    public function getInactiveUsers(): array
    {
        // TODO: Implement getInactiveUsers() method.
    }

    public function getUsersByRole(UserRoleEnum $role): array
    {
        // TODO: Implement getUsersByRole() method.
    }

    public function findByPhone(string $username): ?BaseUserModelInterface
    {
        // TODO: Implement findByPhone() method.
    }

    public function phoneExists(string $phone): bool
    {
        // TODO: Implement phoneExists() method.
    }

    public function emailExists(string $email): bool
    {
        // TODO: Implement emailExists() method.
    }
}
