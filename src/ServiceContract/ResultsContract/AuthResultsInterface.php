<?php

namespace andeh\Framework\ServiceContract\ResultsContract;

interface AuthResultInterface
{
    public function isSuccess(): bool;

    public function getMessage(): ?string;

    public function getError(): ?string;

    public function getOperation(): ?string;

    public function getRecordId(): int|string|null;

    public function getToken(): ?string;

    public function getMeta(): array;

    public function getOperationDate(): \DateTimeImmutable;
}
