<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Country;
use App\Entity\Product;
use App\Entity\Order;

class CalcController extends AbstractController
{
    public function index(Request $request): Response
    {
        $countries = [
            new Country("Германия", "DE", 19),
            new Country("Италия", "IT", 22),
            new Country("Греция", "GR", 24)
        ];

        $products =  [
            new Product(1, "Наушники", 100),
            new Product(2, "Чехол для телефона", 20)
        ];

        $order = new Order();

        $form = $this->createFormBuilder($order)
                ->add('product', ChoiceType::class, ['choices' => $products, 'choice_value' => 'id', 'choice_label' => function($item){return $item->getName() . " - " . $item->getPrice() . " Евро";}, 'invalid_message' => 'Такого товара нет в продаже', 'attr' => ['class' => 'form-control']])
                ->add('tax', TextType::class, ['attr' => ['class' => 'form-control']])
                ->add('save', SubmitType::class, ['label' => 'Расчитать цену', 'attr' => ['class' => 'w-100 btn btn-lg btn-primary']])->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();
            $country = $order->findCountry($countries);
            $price = $order->getProduct()->calculate($country);

            return $this->render("index.html.twig", ["form" => $form->createView(), "order" => $order, "country" => $country, "price" => $price]);
        }

        return $this->render("index.html.twig", ["form" => $form->createView(), "order" => null]);
    }
}