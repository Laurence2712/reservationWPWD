<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Artist;
use App\Form\ArtistTransfertType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AgentController extends AbstractController
{
    /**
     * @Route("/agent", name="agent")
     */
    public function index()
    {
        $repository = $this->getdoctrine()->getRepository(Agent::class);
        $agents = $repository->findAll();
        
        return $this->render('agent/index.html.twig', [
            'title' => 'Liste des agents',
            'agents' => $agents,
        ]);
    }
    
    /**
     * @Route("/agent/{id}/transfert/{artistId}", name="agent_transfert")
     */
    public function transfert(Request $request, int $id, int $artistId): Response
    {
        //Autorisation: seul l'admin a accès (mettez en commentaire pour tester sans)
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $user = $this->getUser();
        
        /*if(!in_array('admin',$user->getRoles())) {
            throw new \Exception('Access denied for user without "admin" role.');
        }*/
        //----
        
        $repository = $this->getDoctrine()->getRepository(Artist::class);
        $artist = $repository->find($artistId);
        
        $form = $this->createForm(ArtistTransfertType::class,$artist);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
           //Persister les modifications de l'artiste
           $this->getDoctrine()->getManager()->flush();
           
           //Redirection vers la fiche de l'artiste
           return $this->redirectToRoute('artist_show',['id'=>$artist->getId()]);
        }
        
        return $this->render('agent/transfert.html.twig', [
            'artist' => $artist,
            'formTransfert' => $form->createView(),
        ]);
    }

     /**
     * @Route("/agent/new", name="agent_create")
     */
    /*public function create(Request $request, EntityManagerInterface $manager): response
    {

        $agent = new Agent();

        $form = $this->creatForm(AgentType::class, $agent);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Persister 
            $manager->persist($agent);
            $manager->flush();
            
            return $this->redirectToRoute('agent_show,['id'=>$agent->getId()] ');
         }
         return $this->render('agent/create.html.twig', [
            'agent' => $agent,
            'formAgent' => $form->createView(),
        ]);
    }*/

    /**
     * @Route("/agent", name="agent")
     */
    public function show($id)
    {
        $repository = $this->getdoctrine()->getRepository(Agent::class);
        $agent = $repository->find($id);
        
        return $this->render('agent/show.html.twig', [
            'agent' => $agent,
        ]);
    }
}