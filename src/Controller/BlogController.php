<?php

namespace App\Controller;

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
        return $this->render('blog/add.html.twig');
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
