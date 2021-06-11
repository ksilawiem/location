<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Voiture;
use App\Entity\Marque;
use App\Entity\Client;
use App\Entity\Location;
use App\Form\ClientType;
use App\Entity\Contact;
use App\Form\ContactType;
use Knp\Component\Pager\PaginatorInterface;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $Voitures=$this->getDoctrine()->getRepository(Voiture::class)->findAllGreaterThanPub("1");
        $Voits=$this->getDoctrine()->getRepository(Voiture::class)->findAll2();
        $VoitC=$this->getDoctrine()->getRepository(Voiture::class)->findAllCount();
        $Marque=$this->getDoctrine()->getRepository(Marque::class)->findAll();

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contact);
        $entityManager->flush();

        $this->addFlash('success','Envoyer avec succées');
        return $this->redirectToRoute('site');
    }


        return $this->render('site/index.html.twig', [
            'Voitures' =>  $Voitures,'Voits' =>  $Voits, 'VoitsC' =>  $VoitC, 'Marq' => $Marque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/propos", name="propos")
     */
    public function propos()
    {
        return $this->render('site/propos.html.twig', [
            'Voitures' =>  '',
        ]);
    }

    /**
     * @Route("/voitures", name="voitures")
     */
    public function voitures(Request $request, PaginatorInterface $paginator)
    {
        //$Voits=$this->getDoctrine()->getRepository(Voiture::class)->findAll1();
     
      $nom=$request->query->getAlnum('nom');
      $prix=$request->query->getAlnum('prix');
      $Voits=$this->getDoctrine()->getRepository(Voiture::class)->findAll1($nom,$prix);
      $Loc=$this->getDoctrine()->getRepository(Location::class)->findAll();
        $voitures = $paginator->paginate(
            $Voits, // Requête contenant les données à paginer (ici nos voitures)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );
      
        return $this->render('site/voitures.html.twig', [
           'Voits' => $voitures, 'Loc' => $Loc,
        ]);
    }


    /**
     * @Route("/services", name="services")
     */
    public function services()
    {
        return $this->render('site/services.html.twig', [
            'Voitures' =>  '',
        ]);
    }


    /**
     * @Route("/contact", name="contact", methods={"GET","POST"})
     */
    public function contact(Request $request): Response
    {

        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($client);
        $entityManager->flush();

        $this->addFlash('success','Envoyer avec succées');
        return $this->redirectToRoute('voitures');
    }

        return $this->render('site/contact.html.twig', [
          'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/devis", name="devis", methods={"GET","POST"})
     */
    public function devis(Request $request): Response
    {
        $voit=$_GET['voit'];
        $nbv=$_GET['nbv'];
        $prix=$_GET['prixj'];
        $nomclt=$_GET['nomclt'];
        $prenomclt=$_GET['prenomclt'];
        $email=$_GET['email'];
        $tel=$_GET['tel'];
        $adresse=$_GET['adresse'];
        $somme=$_GET['som'];
      
        return $this->render('site/devis.html.twig', [
          'prix' => $prix,'adresse' => $adresse,'email' => $email,'tel' => $tel,
          'voiture' => $voit,'nomclt' => $nomclt,'prenomclt' => $prenomclt,'nbv' => $nbv,
          'somme' => $somme,
        ]);
    }

}
