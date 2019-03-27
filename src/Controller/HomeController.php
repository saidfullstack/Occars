<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ArticleRepository $repository
     * @return Response
     */
    public function index(ArticleRepository $repository):Response
    {
        $articles = $repository->findBy([], ["id"=>"desc"], 4);
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
