<?php


namespace App\Controller;


use App\Entity\BookingOffer;
use App\Form\BookingOfferSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $bookingOffer = new BookingOffer();
        $form = $this->createForm(BookingOfferSearchType::class, $bookingOffer, [
            'attr' => [
                'class' => 'form-inline'
            ]
        ]);
        return $this->render('index/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}