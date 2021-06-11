<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Voiture;
use App\Entity\Client;
use App\Entity\Location;
use App\Entity\Contact;
use App\Form\InscriptionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }



     /**
     * @Route("/inscription", name="app_inscription")
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $encoder): response
    {
        $user =new User();

        $form=$this->createForm(InscriptionType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pass=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($pass);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }


     /**
     * @Route("/dashboard", name="app_dashboard")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function dashboard(Request $request): response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $VoitC=$this->getDoctrine()->getRepository(Voiture::class)->findAllCount();
        $UserC=$this->getDoctrine()->getRepository(User::class)->findAllCount();
        $ClientC=$this->getDoctrine()->getRepository(Client::class)->findAllCount();
        $LocationC=$this->getDoctrine()->getRepository(Location::class)->findAllCount();
        $ContactC=$this->getDoctrine()->getRepository(Contact::class)->findAllCount();
        return $this->render('security/dashboard.html.twig', [
        'VoitsC' =>  $VoitC, 'UsersC' =>  $UserC, 'LocationC' =>  $LocationC, 'ClientC' =>  $ClientC, 'ContactC' =>  $ContactC,
        ]);
    }
}
