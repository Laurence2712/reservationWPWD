<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Role;

class RoleController extends AbstractController
{
    /**
     * @Route("/role", name="role")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Role::class);
        $roles = $repository->findAll();
        $titre = 'Liste des rôles';


        return $this->render('role/index.html.twig', [
            'titre' => $titre,
            'roles' => $roles,
        ]);
    }
    /**
     * @Route("/role/{id}", name="role_show")
     */
    public function show(Role $role){

        $titre = 'Fiche rôle';

        return $this->render('role/index.html.twig', [
            'role' => $role,
            'titre'=>$titre,
        ]);
    }
}
