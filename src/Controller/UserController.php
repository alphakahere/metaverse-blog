<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
 
        return $this->render('admin/users/index.html.twig', [
            'users' => $users
        ]);
    }

    //remove user
    public function remove(User $user)
    {
        if (is_null($user)) {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash(
            'success',
            'Utilisateur supprimé avec succès.'
        );
        return $this->redirectToRoute('admin_users');
    }
}
