<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_index", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function user(Request $request, UserRepository $userRepository, PaginatorInterface $paginator) {
      //$user = $userRepository->findAll();
      $entityManager = $this->getDoctrine()->getManager();
        $queryBuilder=$entityManager->getRepository('App\Entity\User')->createQueryBuilder('u');
        $queryBuilder->where('u.email LIKE :email')
        ->setParameter('email','%'. $request->query->getAlnum('filter') . '%');
        
        $user=$queryBuilder->getQuery();
      $users = $paginator->paginate(
        $user, // Requête contenant les données à paginer (ici nos users)
        $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
        6// Nombre de résultats par page
    );
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

     /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User  $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
        
    }

}
