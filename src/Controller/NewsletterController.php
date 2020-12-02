<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/newsletter", name="newsletter_")
 */
class NewsletterController extends AbstractController
{
    public function renderForm(Request $request, ValidatorInterface $validator)
    {
        $news_object = new Newsletter();
        $news_form = $this->createForm(NewsletterType::class, $news_object, [
            'action' => $this->generateUrl('newsletter_signup'),
            'method' => 'POST'
        ]);
        if($this->getUser()!=null)
        {
            $news_form->get('email')->setData($this->getUser()->getEmail());
        }
        $news_form->handleRequest($request);
        $errors = $validator->validate($news_object);
        return $this->render('newsletter/form.html.twig', [
            'newsletterForm' => $news_form->createView(),
            'errors' => $errors
        ]);
    }

    /**
     * @Route("/signup", name="signup")
     * @param Request $request
     */
    public function signUp(Request $request)
    {
        dd($request);
    }
}
