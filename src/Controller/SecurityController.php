<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $user = new User();
        $user->setRegistrationDate( new \DateTime('now'));
        $form = $this->createForm(LoginType::class, $user);

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'last_Username' => $lastUsername,
            'error' => $error
        ]);
    }
}
