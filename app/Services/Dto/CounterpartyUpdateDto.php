<?php

namespace App\Services\Dto;

class CounterpartyUpdateDto
{
    public function __construct
    (
        public int $id,
        public string $name,
        public string $email,
        public string $code,
        public string $adress,
    ){}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getAdress(): string
    {
        return $this->adress;
    }
}