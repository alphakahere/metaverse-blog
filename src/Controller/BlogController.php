<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('blog/index.html.twig');
    }

    // Add Article
    public function add(): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        return $this->render('blog/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

     // edit Article
     public function edit(): Response
     {
         return $this->render('blog/edit.html.twig');
     }

    //remove Article
    public function remove(): Response
    {
        return new Response("Article supprime avec succes");
    }
}
