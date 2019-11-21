<?php


namespace App\Controller\Offer;

use App\Entity\Destination;
use App\Entity\BookingOffer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;



class OfferController extends AbstractController
{
    /**
     * @Route("/offers/{destination}", name="offers")
     */
    public function OffersForDestination(string $destination)
    {
        $em = $this->getDoctrine()->getManager();
        $fetchedDestination = $em->getRepository(Destination::class)->findOneBy(["destinationName" => $destination]);
        if($fetchedDestination == null) return new RedirectResponse($this->generateUrl('destinations'));
        $offers = $em->getRepository(BookingOffer::class)->findBy(["destination" => $fetchedDestination]);
        return $this->render('offer/for_destination.html.twig', [
            'controller_name' => 'OfferController',
            'offers' => $offers,
            'destination' => $destination
        ]);
    }
}