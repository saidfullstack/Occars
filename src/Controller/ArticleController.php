<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{

    /**
     * @Route("/articles", name="article.index")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'current_menu' => 'properties',
        ]);
    }

    /**
     * @Route("/articles/{slug}-{id}", name="article.show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show(Article $article, string $slug)
    {
       if ($article->getSlug() !== $slug) {
           return $this->redirectToRoute('article.show', [
               'id'   => $article->getId(),
               'slug' => $article->getSlug()
           ], 301);
       }

       return $this->render('article/show.html.twig',[
           'article' => $article,
           'current_menu' => 'properties',
       ]);
    }
}
