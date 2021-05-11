<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Agence;
use App\Form\AgenceType;
class AgenceController extends AbstractController
{
    /**
    * @Route("/admin/ajouter", name="admin")
    */
    public function createagence(Request $request): Response
    {   
        $agence = new agence();
        $form = $this->createForm(agenceType::class,$agence);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entitymanager=$this->getDoctrine()->getManager();
            $entitymanager->persist($agence);
            $entitymanager->flush();
            return $this->redirectToRoute('ajouter-agence');
        }
        return $this->render('agence/index.html.twig', [
            'form' =>$form->createView()
        ]);
    }
    /**
    * @Route("/admin/modifier/agence/{id}", name="modifier-agence")
    */
    public function modifieragence(Request $request, $id): Response
    {   $entityManager = $this->getDoctrine()->getManager();
        $agence = $entityManager->getRepository(Product::class)->find($id);
        $form = $this->createForm(agenceType::class,$agence);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entitymanager=$this->getDoctrine()->getManager();
            $entitymanager->persist($agence);
            $entitymanager->flush();
            return $this->redirectToRoute('ajouter-agence');
        }
        return $this->render('agence/index.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
    * @Route("/admin/supprimer/agence/{id}", name="ajouter-agence")
    */
    public function supprimeragence($id){
        $entityManager = $this->getDoctrine()->getManager();
        $agence = $entityManager->getRepository(Product::class)->find($id);
        $entityManager->remove($agence);
        $entityManager->flush();
    }

}
