<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/aboutus', name: 'main_aboutus')]
    public function home()
    {
        echo "coucou";
        die();
    }
}
