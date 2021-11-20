<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact")
     */
    public function index(
        Request $request,
        EntityManagerInterface $em
    ): Response {

        $contactMessage = new ContactMessage();

        $form = $this->createForm(ContactType::class, $contactMessage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isSubmitted()) {

            $em->persist($contactMessage);
            $em->persist($contactMessage->getContactUser());
            $em->flush();

            $this->addFlash('success', 'Your message has been sent successfully');

            return $this->redirectToRoute('contact');

        }


        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'ContactController',
        ]);
    }
}
