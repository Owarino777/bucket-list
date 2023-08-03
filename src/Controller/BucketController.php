<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bucket', name: 'bucket_')]

class BucketController extends AbstractController
{
    #[Route('', name: 'list')]
    public function list(): Response
    {
        //todo: aller chercher les séries en bdd
        return $this->render('bucket/list.html.twig', []);
    }

    #[Route('/details/{id}', name: 'details')]
    public function details(int $id): Response
    {
        //todo: aller chercher la série en bdd
        return $this->render('bucket/details.html.twig', []);
    }

    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        return $this->render('bucket/create.html.twig', []);
    }
}
