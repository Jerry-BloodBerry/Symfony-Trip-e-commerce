<?php


namespace App\Controller\Offer;

use App\Entity\BookingOffer;
use App\Entity\BookingOfferType;
use App\Entity\Destination;
use App\Entity\Reservation;
use App\Form\BookingOfferFiltersType;
use App\Form\ReservationStartType;
use App\Service\BookingOfferService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\FormInterface;
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
        if ($request->query->get('booking_offer_search')) {
            $offers = $this->getOffersBasedOnRequestQuery($offerService, $request, $bookingOffer);
        } elseif ($request->query->get('offerType')) {
            $offers = $this->getOffersBasedOnOfferType($offerService, $request->query->get('offerType'));
        } elseif ($request->query->get('destinationName')) {
            $offers = $this->getOffersBasedOnDestination($offerService, $request->query->get('destinationName'));
            $queryDestination = $this->getDoctrine()->getRepository(Destination::class)
                ->findOneBy(['destinationName' => $request->query->get('destinationName')]);
            $bookingOffer->setDestination($queryDestination);
        } else {
            $offers = $offerService->findOffers();
        }
        $allOffers = $this->getDoctrine()->getRepository(BookingOffer::class)->findAll();
        foreach ($allOffers as $offer) {
            $departureSpots[$offer->getDepartureSpot()] = $offer->getDepartureSpot();
        }
        $filtersForm = $this->createForm(BookingOfferFiltersType::class, $bookingOffer, [
            'method' => 'GET',
            'departureSpots' => $departureSpots
        ]);
        $filtersForm->handleRequest($request);
        if ($filtersForm->isSubmitted() && $filtersForm->isValid()) {
            $offers = $this->getOffersBasedOnFormSubmission($offerService, $filtersForm, $bookingOffer);
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
        $reservation = new Reservation();
        $reservation->setBookingOffer($offer);
        $reservationForm = $this->createForm(ReservationStartType::class, $reservation);
        $finder = new Finder();
        $finder->files()->in($offer->getPhotosDirectory());
        $photosCount = 0;
        if ($finder->hasResults()) {
            $photosCount = $finder->count();
        }
        return $this->render('offer/single_offer.html.twig', [
            'offer' => $offer,
            'reservationForm' => $reservationForm,
            'photosCount' => $photosCount
        ]);
    }

    private function getWellFormattedDate(string $date)
    {
        $reformatted = explode('/', $date);
        $reformatted = $reformatted[2] . '/' . $reformatted[1] . '/' . $reformatted[0];
        return new \DateTime($reformatted);
    }

    private function getOffersBasedOnFormSubmission(BookingOfferService $offerService, FormInterface $filtersForm, BookingOffer $bookingOffer)
    {
        $priceMin = $filtersForm->get('priceMin')->getData();
        $priceMax = $filtersForm->get('priceMax')->getData();
        $offerTypes = $filtersForm->get('offerTypes')->getData();
        return $offerService->findOffers(
            $bookingOffer->getDepartureSpot(),
            $bookingOffer->getDestination(),
            $bookingOffer->getDepartureDate(),
            $bookingOffer->getComebackDate(),
            $priceMin,
            $priceMax,
            $offerTypes
        );
    }

    private function getOffersBasedOnRequestQuery(BookingOfferService $offerService, Request $request, BookingOffer $bookingOffer)
    {
        $requestParams = $request->query->get('booking_offer_search');
        $departureSpot = $requestParams['departureSpot'] ?? null;
        $destination = $requestParams['destination'] ?? null;
        $departureDate = $requestParams['departureDate'] ?? null;
        $comebackDate = $requestParams['comebackDate'] ?? null;
        if ($departureDate != null) {
            $bookingOffer->setDepartureDate($this->getWellFormattedDate($departureDate));
        }
        if ($comebackDate != null) {
            $bookingOffer->setComebackDate($this->getWellFormattedDate($comebackDate));
        }
        $bookingOffer->setDepartureSpot($departureSpot);
        $bookingOffer->setDestination($this->getDoctrine()->getRepository(Destination::class)->find($destination));
        return $offerService->findOffers($departureSpot,
            $destination,
            $bookingOffer->getDepartureDate(),
            $bookingOffer->getComebackDate());
    }

    private function getOffersBasedOnOfferType(BookingOfferService $offerService, string $offerTypeName)
    {
        $offerType = $this->getDoctrine()->getRepository(BookingOfferType::class)->findOneBy(['typeName' => $offerTypeName]);
        if ($offerType != null) {
            $offers = $offerService->findOffers(null, null, null, null, null, null, [$offerType]);
        } else {
            $offers = null;
        }
        return $offers;
    }

    private function getOffersBasedOnDestination(BookingOfferService $offerService, string $destinationName)
    {
        $destination = $this->getDoctrine()->getRepository(Destination::class)->findOneBy(['destinationName' => $destinationName]);
        if ($destination != null) {
            $offers = $offerService->findOffers(null, $destination, null, null, null, null, null);
        } else {
            $offers = null;
        }
        return $offers;
    }
}