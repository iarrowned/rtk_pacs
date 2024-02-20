<?php

namespace Response;

class ErrorResponse extends AbstractResponse
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
        $this->status = false;
    }
}