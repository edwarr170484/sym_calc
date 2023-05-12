<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Country;

class Product
{
    private $id;
    private $name;
    private $price;

    public function __construct(int $id, string $name, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function calculate($country): float
    {
        return $country ? $this->price + ($this->price * $country->getTax() / 100) : 0;
    }
}