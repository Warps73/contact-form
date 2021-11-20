<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Entity\ContactUser;
use App\Repository\ContactUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ContactUserRepository $contactUserRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'contact_users' => $contactUserRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/contact-user/{userId}", name="admin_user_manage_message")
     * @ParamConverter("contactUser", options={"id" = "userId"})
     */
    public function manageMessageByUser(ContactUser $contactUser): Response
    {
        return $this->render('admin/contact_messages.html.twig', [
            'contact_user' => $contactUser,
        ]);
    }

    /**
     * @Route("/admin/contact-message/{messageId}", name="admin_ajax_processed_contact_message")
     * @ParamConverter("contactMessage", options={"id" = "messageId"})
     */
    public function ajaxProcessedContactMessage(ContactMessage $contactMessage, EntityManagerInterface $em)
    {

        $contactMessage->setProcessed(!$contactMessage->getProcessed());
        $em->persist($contactMessage);
        $em->flush();
        
        return new JsonResponse([
            'success' => true,
        ]);
    }
}
