<?php

namespace App\Controller;
use App\Entity\Agence;
use App\Entity\Voiture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {   $agences=$this->getDoctrine()->getRepository(Agence::class)->findAll();
        $voitures=$this->getDoctrine()->getRepository(Voiture::class)->findAll();
        return $this->render('admin.html.twig', ['agences'=>$agences, 'voitures'=>$voitures ]);
    }
     /**
     * @Route("/voiture/ajouter", name="ajoutervoiture")
     */
    public function ajoutervoiture()
    {   $entitymanager= $this->getDoctrine()->getManager();
        $voiture = new Voiture();
        $voiture->setMatricule(43542323);
        $voiture->setMarque("bmw");
        $voiture->setCouleur("black");
        $voiture->setCarburant("fhgm");
        $voiture->setNbrplace("4");
        $voiture->setDescription("dqdmm");
        $voiture->setDisponibilite("oui");
        $voiture->setDatemiseencirculation(new \DateTime());
        $entitymanager->persist($voiture);
        $entitymanager->flush();
        return $this->render('ajoutervoiture.html.twig');

    }
    /**
     * @Route("/voiture/modifier/{id}", name="modifiervoiture")
     */
    public function modifiervoiture()
    {   
        return $this->render('modifiervoiture.html.twig');
    }
    /**
     * @Route("/voiture/supprimer/{id}", name="supprimervoiture")
     */
    public function supprimervoiture($id)
    {   
        $entitymanager=$this->getDoctrine()->getManager();
        $voiture=$this->getDoctrine()->getRepository(Voiture::class)->findOneBy(array('id'=>$id));
        $entitymanager->remove($voiture);
        $entitymanager->flush();
        return (true);
    }

    /**
     * @Route("/agence/ajouter", name="ajouteragence")
     */
    public function ajouteragence()
    {   $entitymanager= $this->getDoctrine()->getManager();
        $agence = new Agence();
        $agence->setNom("shh");
        $agence->setTelAgence(2229877);
        $agence->setAdresseVille("tunis rue de rome");
        $entitymanager->persist($agence);
        $entitymanager->flush();
        return $this->render('ajouteragence.html.twig');
    }
    /**
     * @Route("/agence/modifier/{id}", name="modifieragence")
     */
    public function modifieragence()
    {   
        return $this->render('modifieragence.html.twig');
    }
    /**
     * @Route("/agence/supprimer/{id}", name="supprimeragence")
     */
    public function supprimeragence($id)
    {
        $entitymanager=$this->getDoctrine()->getManager();
        $agence=$this->getDoctrine()->getRepository(agence::class)->findOneBy(array('id'=>$id));
        $entitymanager->remove($agence);
        $entitymanager->flush();
        return (true);
        

    }
    
}
