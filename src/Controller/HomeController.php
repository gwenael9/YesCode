<?php

// Response pas vraiment utile, on peux le supprimer si on veut
// namespace sert à éviter les collisions
namespace App\Controller;

use App\Entity\Fruit;
use App\Repository\FruitRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index(FruitRepository $repo){

        $fruits = $repo->findAll();
        dump($fruits);

        return $this->render('home/index.html.twig', []);
    }

}
