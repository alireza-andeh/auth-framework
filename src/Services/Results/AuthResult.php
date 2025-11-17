<?php

declare(strict_types=1);

namespace andeh\Framework\Services\Results;

use andeh\Framework\ServiceContract\ResultsContract\AuthResultInterface;

class AuthResult implements AuthResultInterface
{
    protected bool $success = false;
    protected ?string $token = null;
    protected ?string $error = null;
    protected ?string $message = null;
    protected ?string $operation = null;
    protected int|string|null $recordId = null;
    protected array $meta = [];
    protected \DateTimeImmutable $operationDate;

    /**
     * Constructor protected: Forces developers to use factory methods
     */
    protected function __construct(?string $operation = null)
    {
        $this->operation = $operation;
        $this->operationDate = new \DateTimeImmutable();
    }

    /**
     * Success factory method
     */
    public static function success(
        ?string $message = null,
        string $operation = 'login',
        int|string|null $recordId = null,
        array $meta = [],
        ?string $token = null
    ): static {
        $instance = new static($operation);

        $instance->success = true;
        $instance->message = $message;
        $instance->recordId = $recordId;
        $instance->meta = $meta;
        $instance->token = $token;

        return $instance;
    }

    /**
     * Failure factory method
     */
    public static function failure(
        ?string $message,
        ?string $error = null,
        string $operation = 'login',
        array $meta = [],
        int|string|null $recordId = null
    ): static {
        $instance = new static($operation);

        $instance->success = false;
        $instance->message = $message;
        $instance->error = $error;
        $instance->recordId = $recordId;
        $instance->meta = $meta;

        return $instance;
    }

    // -------------------- GETTERS --------------------

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function getRecordId(): int|string|null
    {
        return $this->recordId;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function getOperationDate(): \DateTimeImmutable
    {
        return $this->operationDate;
    }

    // -------------------- Fluent Modifiers --------------------

    public function withMeta(array $meta): static
    {
        $this->meta = array_merge($this->meta, $meta);
        return $this;
    }

    public function withMessage(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    public function withToken(string $token): static
    {
        $this->token = $token;
        return $this;
    }
}
