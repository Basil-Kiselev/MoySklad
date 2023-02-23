<?php

namespace App\Services\Dto;

class ProductfolderCreateDto
{
    public function __construct(
        public string $name,
        public string $code,        
        public string $description,
    ){}

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }
}