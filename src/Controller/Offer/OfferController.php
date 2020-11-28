<?php


namespace App\Controller\Offer;

use App\Entity\BookingOffer;
use App\Entity\Destination;
use App\Form\BookingOfferFiltersType;
use App\Service\BookingOfferService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offer", name="offer_")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/browse", name="browse")
     * @param Request $request
     * @param BookingOfferService $offerService
     * @return Response
     * @throws Exception
     */
    public function displayOfferList(Request $request, BookingOfferService $offerService)
    {
        $bookingOffer = new BookingOffer();
        if($request->query->get('booking_offer_search')) {
            $requestParams = $request->query->get('booking_offer_search');
            $departureSpot = $requestParams['departureSpot'] ?? null;
            $destination = $requestParams['destination'] ?? null;
            $departureDate = $requestParams['departureDate'] ?? null;
            $comebackDate = $requestParams['comebackDate'] ?? null;
            $offers = $offerService->findOffers($departureSpot,
                $destination,
                $departureDate,
                $comebackDate);
            $bookingOffer->setDepartureSpot($departureSpot);
            $bookingOffer->setDestination($this->getDoctrine()->getRepository(Destination::class)->find($destination));
            if($departureDate!=null) {
                $date = explode('/',$departureDate);
                $date = $date[2] . '/' . $date[1] . '/' . $date[0];
                $bookingOffer->setDepartureDate(new \DateTime($date));
            }
            if($comebackDate!=null) {
                $date = explode('/',$comebackDate);
                $date = $date[2] . '/' . $date[1] . '/' . $date[0];
                $bookingOffer->setComebackDate(new \DateTime($date));
            }

        } else {
            $offers = $offerService->findOffers();
        }
        $filtersForm = $this->createForm(BookingOfferFiltersType::class, $bookingOffer, [
            'method' => 'GET'
        ]);
        $filtersForm->handleRequest($request);

        if($filtersForm->isSubmitted() && $filtersForm->isValid()) {
            $priceMin = $filtersForm->get('priceMin')->getData();
            $priceMax = $filtersForm->get('priceMax')->getData();
            $offerTypes = $filtersForm->get('offerTypes')->getData();
            $offers = $offerService->findOffers(
                $bookingOffer->getDepartureSpot(),
                $bookingOffer->getDestination(),
                $bookingOffer->getDepartureDate(),
                $bookingOffer->getComebackDate(),
                $priceMin,
                $priceMax,
                $offerTypes
            );
        }
        return $this->render('offer/browser.html.twig', [
            'offers' => $offers,
            'parameters' => $request->attributes->all(),
            'filtersForm' => $filtersForm
        ]);
    }

    /**
     * @Route ("/{id}", name="single")
     * @param int $id
     * @return Response
     */
    public function displayOffer($id)
    {
        $offer = $this->getDoctrine()->getRepository(BookingOffer::class)->find($id);
        return $this->render('offer/single_offer.html.twig', [
            'offer' => $offer
        ]);
    }
}