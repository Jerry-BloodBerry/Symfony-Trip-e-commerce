<?php


namespace App\Controller\UsersData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\CustomersRating;
use App\Entity\BookingOffer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateOfferController extends AbstractController
{
    /**
     * @Route ("rateOffer/{id}", name="rateOffer")
     * @param int $id
     * @return Response
     */
    public function displayRateOfferForm($id)
    {
        $offer = $this->getDoctrine()->getRepository(BookingOffer::class)->find($id);
        $rateForm = $this->createForm(CustomersRatingType::class, $offer, [
            'method' => 'GET'
        ]);
        if ($rateForm->isSubmitted() && $rateForm->isValid()) {
            dd($rateForm);
            //$offers = $this->getOffersBasedOnFormSubmission($offerService, $filtersForm, $bookingOffer);
            //TODO - add rating to db
        }
        return $this->redirectToRoute("reservations");
    }
}