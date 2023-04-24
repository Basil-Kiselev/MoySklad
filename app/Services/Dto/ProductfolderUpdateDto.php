<?php

namespace App\Services\Dto;

class ProductfolderUpdateDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $code,        
        public string $description,
    ){}

    public function getId(): int
    {
        return $this->id;
    }

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