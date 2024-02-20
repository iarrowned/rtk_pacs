<?php

namespace Response;

class SuccessResponse extends AbstractResponse
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
        $this->status = true;

    }
}