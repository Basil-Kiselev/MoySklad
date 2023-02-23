<?php

namespace App\Services\Dto;

class StoreCreateDto
{
    public function __construct(
        public string $name,
        public string $code,
        public string $adress,
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

    public function getAdress(): string
    {
        return $this->adress;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}