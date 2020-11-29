<?php


namespace App\Controller\UsersData;

use App\Entity\Reservation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservations", name="reservations")
     */
    public function index()
    {
        $auth_checker = $this->get('security.authorization_checker');
        if($auth_checker->isGranted('ROLE_USER')) {
            $userId = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $em = $this->getDoctrine()->getManager();
            $reservations = $em->getRepository(Reservation::class)->findByUserId($userId);
            return $this->render('reservations/index.html.twig', [
                'controller_name' => 'ReservationController',
                'reservations' => $reservations
            ]);
        }
        else
            return $this->redirectToRoute("app_login");
    }

}