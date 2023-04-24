<?php

namespace App\Services\Dto;

class ProductCreateDto
{
    public function __construct
    (
        public string $article,
        public string $code,
        public string $name,
        public float $minPrice,
    ){}
    
    public function getArticle(): string
    {
        return $this->article;   
    }

    public function getCode(): string
    {
        return $this->code;   
    }

    public function getName(): string
    {
        return $this->name;   
    }

    public function getMinPrice(): float
    {
        return $this->minPrice;   
    }
}