<?php

// Response pas vraiment utile, on peux le supprimer si on veut
// namespace sert à éviter les collisions
namespace App\Controller;

use stdClass;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'truc' => "Page d'accueil",
        ]);
    }

}
