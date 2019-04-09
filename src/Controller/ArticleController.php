<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleSearch;
use App\Form\ArticleSearchType;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{

    /**
     * @Route("/articles", name="article.index")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {


        $articles =
            $paginator->paginate($this->getDoctrine()
            ->getRepository(Article::class)->findAll(),
            $request->query->getInt('page', 1),6

        );
        return $this->render('article/index.html.twig', [
            'current_menu' => 'properties',
            'articles' => $articles,
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
