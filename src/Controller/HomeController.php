<?php


namespace App\Controller;


use App\Entity\BookingOffer;
use App\Entity\Destination;
use App\Form\BookingOfferSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $bookingOffer = new BookingOffer();
        $destinations = $this->getDoctrine()->getRepository(Destination::class)->findAll();
        $destinations = Destination::sortDestinationsByName($destinations);
        $form = $this->createForm(BookingOfferSearchType::class, $bookingOffer, [
            'attr' => [
                'class' => 'form-inline'
            ],
            'method' => 'GET',
            'destinations' => $destinations
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            return $this->forward('App\Controller\Offer\OfferController::getOffers', [
               'departureSpot' => null,
               'destination' => $bookingOffer->getDestination(),
               'departureDate' => $bookingOffer->getDepartureDate(),
               'comebackDate' => $bookingOffer->getComebackDate()
            ]);
        }
        return $this->render('index/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}