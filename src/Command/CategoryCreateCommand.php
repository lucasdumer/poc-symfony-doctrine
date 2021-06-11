<?php

namespace App\Command;

class CategoryCreateCommand
{
    public function __construct(
        private string $name
    ) {}

    public function getName(): string
    {
        return $this->name;
    }
}