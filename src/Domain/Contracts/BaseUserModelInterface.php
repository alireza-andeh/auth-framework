<?php 

namespace andeh\Framework\Domain\Contracts;


interface BaseUserModelInterface
{
    public function getId(): int|string;


    public function getIdentifier(): string;

    public function getPasswordHash(): string;
    public function isActive(): bool;
}