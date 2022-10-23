<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    public function index()
    {
        return $this->render('blog/index.html.twig');
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
                $filename = $file->getClientOriginalName() . '_' . uniqid(). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), // Le dossier dans lequel le fichier va être charger
                        $filename
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return new Response('Article ajouté avec succès.');
        } 
        // else{
        //     return new Response("No");
        // }
        return $this->render('blog/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

     // edit Article
     public function edit()
     {
         return $this->render('blog/edit.html.twig');
     }

    //remove Article
    public function remove()
    {
        return new Response("Article supprime avec succes");
    }
}
