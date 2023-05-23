<?php

// Response pas vraiment utile, on peux le supprimer si on veut
// namespace sert à éviter les collisions
namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index(ArticleRepository $repo){

        $articles = $repo->findLastArticles(3);

        return $this->render('home/index.html.twig', [
            'articles' => $articles
        ]);
    }

}
