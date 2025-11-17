<?php 


namespace andeh\Framework\Infrastructure\Contract\Repositories;
use andeh\Framework\Domain\Contracts\BaseUserModelInterface;

interface BaseUserRepositoryInteface {
    public function findById(int | string $id):?BaseUserModelInterface;
    public function findByIdentifier(string $identifier):?BaseUserModelInterface;
    public function existsByIdentifier(string $identifier): bool;
    public function create(BaseUserModelInterface $user):bool;
    public function update(BaseUserModelInterface $user):bool;
    public function delete(int | string $id):bool;
    public function getAll():array;
}

