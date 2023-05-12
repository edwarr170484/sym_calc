<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use App\Entity\Product;

class Order
{
    protected $product;
    
    protected $tax;

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product= $product;
    }

    public function getTax(): string
    {
        return $this->tax;
    }

    public function setTax(string $tax): void
    {
        $this->tax = $tax;
    }

    public function findCountry(array $countries): Country
    {
        if($countries)
        {
            foreach($countries as $country)
            {
                if(strtolower(substr($this->tax, 0, 2)) == strtolower($country->getCode()))
                {
                    return $country;
                }
            }
        }

        return null;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('product', new Assert\NotBlank([
            'message' => 'Выберите конкретный товар'
        ]));

        $metadata->addPropertyConstraint('tax', new Assert\NotBlank([
            'message' => 'Введите tax номер'
        ]));
        $metadata->addPropertyConstraint('tax', new Assert\Regex([
            'pattern' => '/^\w{2}[0-9]+$/',
            'match' => true,
            'message' => 'Неверный формат tax номера',
        ]));
    }
}