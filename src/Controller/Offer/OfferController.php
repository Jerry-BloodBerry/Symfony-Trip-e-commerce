<?php


namespace App\Controller\Offer;

use App\Service\BookingOfferService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offer", name="offer_")
 */
class OfferController extends AbstractController
{
    /**
     * @param Request $request
     * @param BookingOfferService $offerService
     * @param double|null $priceMin
     * @param double|null $priceMax
     * @return RedirectResponse|Response
     */
    public function getOffers(Request $request, BookingOfferService $offerService, float $priceMin = null,
                                  float $priceMax = null)
    {
        $requestAttr = $request->attributes->all();
        $departureSpot = $requestAttr['departureSpot'] ?? null;
        $destination = $requestAttr['destination'] ?? null;
        $departureDate = $requestAttr['departureDate'] ?? null;
        $comebackDate = $requestAttr['comebackDate'] ?? null;
        $fetchedOffers = $offerService->findOffers($departureSpot,
            $destination,
            $departureDate,
            $comebackDate,
            $priceMin,
            $priceMax);
        return $this->displayOfferList($request, $offerService, $fetchedOffers);
    }

    /**
     * @Route("/browse", name="browse", defaults={"offers": null})
     * @param Request $request
     * @param BookingOfferService $offerService
     * @param $offers
     * @return Response
     */
    public function displayOfferList(Request $request, BookingOfferService $offerService, $offers)
    {
        if($offers == null) {
            $offers = $offerService->findOffers();
        }
        return $this->render('offer/browser.html.twig', [
            'offers' => $offers,
            'parameters' => $request->attributes->all()
        ]);
    }
}