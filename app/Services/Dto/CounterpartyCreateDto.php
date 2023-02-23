<?php

namespace App\Services\Dto;

class CounterpartyCreateDto
{
    public function __construct
    (
        public string $name,
        public string $email,
        public string $code,
        public string $adress,
    ){}

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