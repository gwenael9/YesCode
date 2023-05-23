<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="articles_index")
     */
    public function index(ArticleRepository $repo): Response {
        
        return $this->render('article/index.html.twig', [
            'articles' => $repo->findAll()
        ]);
    }

    // va nous permettre d'afficher une nouvelle page présentant notre article
    /**
     * @Route("/articles/{slug}", name="article_show")
     */
    public function show($slug, ArticleRepository $repo)
    {
        $article = $repo->findOneBySlug($slug);

        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }
}
