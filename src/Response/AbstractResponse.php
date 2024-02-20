<?php

namespace Response;

use Interface\ResponseInterface;

abstract class AbstractResponse implements ResponseInterface
{
    protected bool $status;
    protected string $message;

    public function __construct(string $message = "")
    {
        $this->message = $message;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message
        ];
    }
}