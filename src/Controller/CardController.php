<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\Type;
use App\Form\CardType;
use App\Form\TypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function index(Request $request)
    {
        $user = $this->getUser();
    	$card = new Card();

    	$form = $this->createForm(CardType::class, $card);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $card = $form->getData();
            $card->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($card);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

    	return $this->render('card/index.html.twig', [
    		'form' => $form->createView(),
    	]);
    }

    /**
     * @Route("/type", name="type")
     */
    public function type(Request $request)
    {
        $type = new Type();

        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $type = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('card/type.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
