<?php


namespace App\Controller\UsersData;

use App\Entity\CustomersRating;
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
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();
            $reservations = $em->getRepository(Reservation::class)->findReservationsByUser($user);

            $isRatingAvailable = [];
            foreach ($reservations as $reservation) {
                $offer = $reservation->getBookingOffer();
                $offerComebackDate = $offer->getComebackDate()->format('Y-m-d');
                $packageId = $offer->getPackageId();
                $isOfferRated = $em->getRepository(CustomersRating::class)->findIfOfferIsRated($user, $packageId);
                $isRatingAvailable[] = (!$isOfferRated and $offerComebackDate < date("Y-m-d"));
            }
            return $this->render('reservations/index.html.twig', [
                'controller_name' => 'ReservationController',
                'reservations' => $reservations,
                'isRatingAvailable' => $isRatingAvailable
            ]);
        }
        else
            return $this->redirectToRoute("app_login");
    }


}