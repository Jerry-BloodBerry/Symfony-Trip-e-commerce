<?php


namespace App\Controller\Offer;

use App\Entity\BookingOffer;
use App\Form\BookingOfferFiltersType;
use App\Service\BookingOfferService;
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
     */
    public function displayOfferList(Request $request, BookingOfferService $offerService)
    {
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
        } else {
            $offers = $offerService->findOffers();
        }
        $bookingOffer = new BookingOffer();
        $filtersForm = $this->createForm(BookingOfferFiltersType::class, $bookingOffer);
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
}