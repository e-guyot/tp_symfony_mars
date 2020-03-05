<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function index()
    {
    	$card = new Card();
    	$form = $this->createFormBuilder($card)
    	->add('title', TextType::class)
    	->add('health', TextType::class)
    	->add('attack', TextType::class)
    	->add('description', TextType::class)
    	->add('cost', TextType::class)
    	->add('type', TextType::class)
    	->add('save', SubmitType::class, ['label' => 'Create Card'])
    	->getForm();

    	$form = $this->createForm(CardType::class, $card);

    	return $this->render('card/index.html.twig', [
    		'form' => $form->createView(),
    	]);
    }
}
