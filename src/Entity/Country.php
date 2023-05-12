<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Country
{
    private $name;
    private $code;
    private $tax;

    public function __construct(string $name, string $code, int $tax)
    {
        $this->name = $name;
        $this->code = $code;
        $this->tax = $tax;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function setTax(int $tax): void
    {
        $this->tax = $tax;
    }
}