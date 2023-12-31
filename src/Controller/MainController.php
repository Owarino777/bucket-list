<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): HttpFoundationResponse
    {
        return $this->render(view: 'main/home.html.twig'); // Remplacez 'home.html.twig' par le nom de votre template Twig pour la page d'accueil
    }

    #[Route('/test', name: 'home_test')]
    public function test(): HttpFoundationResponse
    {
        $serie = [
            "title" => "Game of Thrones",
            "year"  => 2000,
        ];
        return $this->render('main/test.html.twig', [
            "mySerie" => $serie,
            "autreVar" => 4465465
        ]); // Remplacez 'home.html.twig' par le nom de votre template Twig pour la page d'accueil
        #echo 'testounet';
        #die();
    }
}
