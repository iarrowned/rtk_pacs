<?php

namespace Interface;

interface ResponseInterface
{
    public function getStatus(): bool;
    public function getMessage(): string;
    public function toArray(): array;
}