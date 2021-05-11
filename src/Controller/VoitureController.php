<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

class VoitureController extends AbstractController
{
    /**
    * @Route("/ajouter/voiture", name="ajouter-voiture")
    */
    public function createVoiture(Request $request): Response
    {   
        $form = $this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $voiture = new Voiture();
            $voiture->setDisponibilite(1);
            $entitymanager=$this->getDoctrine()->getManager();
            $entitymanager->persist($voiture);
            $entitymanager->flush();
            return $this->redirectToRoute('ajouter-voiture');
        }
        return $this->render('voiture/index.html.twig', [
            'form' =>$form->createView()
        ]);
    }
    /**
    * @Route("/modifier/voiture/{id}", name="ajouter-voiture")
    */
    public function modifierVoiture(Request $request, $id): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $voiture = $entityManager->getRepository(Product::class)->find($id);
        $form = $this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $voiture->setDisponibilite(1);
            $entitymanager=$this->getDoctrine()->getManager();
            $entitymanager->persist($voiture);
            $entitymanager->flush();
            return $this->redirectToRoute('ajouter-voiture');
        }
        return $this->render('voiture/index.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
    * @Route("/supprimer/voiture/{id}", name="ajouter-voiture")
    */
    public function supprimervoiture($id){
        $entityManager = $this->getDoctrine()->getManager();
        $voiture = $entityManager->getRepository(Product::class)->find($id);
        $entityManager->remove($voiture);
        $entityManager->flush();
    }


}
