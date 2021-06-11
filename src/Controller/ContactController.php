<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ContactRepository;
use App\Entity\Contact;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ContactController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(Request $request, ContactRepository $contactRepository, PaginatorInterface $paginator)
    {
       // $contact = $contactRepository->findAll();
        $entityManager = $this->getDoctrine()->getManager();
        $queryBuilder=$entityManager->getRepository('App\Entity\Contact')->createQueryBuilder('c');
        $queryBuilder->where('c.votrelieu LIKE :votrelieu')
        ->setParameter('votrelieu','%'. $request->query->getAlnum('filter') . '%');
        
        $contact=$queryBuilder->getQuery();
        $contacts = $paginator->paginate(
            $contact, // Requête contenant les données à paginer (ici nos contacts)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6// Nombre de résultats par page
        );
        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }


     /**
     * @Route("/contact/{id}", name="contact_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contact  $contact): Response
    {
        if ($this->isCsrfTokenValid('del'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contacts');
        
    }
}
