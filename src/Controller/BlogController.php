<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    public function index(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
        dump($articles);
        return $this->render('blog/index.html.twig', [
            'articles' => $articles
        ]);
    }
    public function show(Article $article){
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }
    // Add Article
    public function add(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $article->setLastUpdateDate(new \DateTime());
            if($article->getIsPublished()){
                $article->setPublicationDate(new \DateTime());
            }
            if($article->getPicture()){
                $file = $form->get('picture')->getData();
                $filename = uniqid(). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), // Le dossier dans lequel le fichier va être charger
                        $filename
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $article->setPicture($filename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return new Response('Article ajouté avec succès.');
        } 
        return $this->render('blog/add.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);

    }

     // edit Article
     public function edit(Article $article, Request $request)
     {
        $oldPicture = $article->getPicture();
        $form = $this->createForm(ArticleType::class, $article);

         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
            $article->setLastUpdateDate(new \DateTime());

            if ($article->getIsPublished()) {
                $article->setPublicationDate(new \DateTime());
            }

            if($article->getPicture() !== null && $article->getPicture() !== $oldPicture){
                $file = $form->get('picture')->getData();
                $filename = uniqid(). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), // Le dossier dans lequel le fichier va être charger
                        $filename
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $article->setPicture($filename);
            }else {
                $article->setPicture($oldPicture);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return new Response('Article modifié avec succès.');
         }

         return $this->render('blog/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView()
         ]);
     }

    //remove Article
    public function remove()
    {
        return new Response("Article supprime avec succes");
    }
}
