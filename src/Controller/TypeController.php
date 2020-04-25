<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Type;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Type::class);
        $types = $repository->findAll();
        $titre = 'Liste des types';
       

        return $this->render('type/index.html.twig', [
            'titre' => $titre,
            'types' => $types,
        ]);
    }

    public function show(Type $type){

        $titre = 'Fiche type';

        return $this->render('type/index.html.twig', [
            'type' => $type,
            'titre'=>$titre,
        ]);
    }
}
