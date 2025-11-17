<?php

namespace andeh\Framework\Domain\Models;


use andeh\Framework\Domain\Contracts\BaseUserModelInterface;


class BaseUser implements BaseUserModelInterface
{
    protected int | string     $id;
    protected string   $identifier;
    protected string   $passwordHash;
    protected bool     $is_active = true;
    protected string   $created_at;
    protected string   $updated_at;

    function __construct(
        int | string $id,
        string   $identifier,
        string   $passwordHash,
        bool     $is_active = true,
        ?string   $created_at = null,
        ?string   $updated_at = null
    )
    {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->passwordHash = $passwordHash;
        $this->is_active = $is_active;
        $this->created_at = $created_at ?? date('Y-m-d H:i:s');
        $this->updated_at = $updated_at ?? date('Y-m-d H:i:s');
    }

    public function getId(): int|string { return $this->id; }
    public function getIdentifier(): string { return $this->identifier; }
    public function getPasswordHash(): string { return $this->passwordHash; }

    public function isActive(): bool{ return $this->is_active; }
    public function getCreatedAt(): string { return $this->created_at; }
    public function getUpdatedAt(): string { return $this->updated_at; }

}