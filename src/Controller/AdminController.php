<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin.article.index")
     */
    public function index(ArticleRepository $repository)
    {
        $articles = $repository->findAll();
        return $this->render('admin/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/admin/create",name="admin.article.new")
     */
    public function new(Request $request)
    {
       $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->persist($article);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Bien créé avec succés');
            return $this->redirectToRoute('admin.article.index');
        }
        return $this->render('admin/new.html.twig', [
            'article' => $article,
            'form'    => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.article.edit", methods="GET|POST")
     */
    public function edit(Article $article, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Bien modifié avec succés');
            return $this->redirectToRoute('admin.article.index');
        }
       return $this->render('admin/edit.html.twig', [
           'article' => $article,
           'form'    => $form->createView()
    ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.article.delete", methods="DELETE")
     */
    public function delete(Article $article, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token'))){
            $this->getDoctrine()->getManager()->remove($article);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Bien supprimé avec succés');
        }
       return $this->redirectToRoute('admin.article.index');
    }
}
