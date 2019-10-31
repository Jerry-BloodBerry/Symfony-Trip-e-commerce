<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;

use App\Form\RegistrationType;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Validator\ValidatorInterface;
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
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('Action forbidden');
    }
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator, ValidatorInterface $validator)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        $errors = $validator->validate($user);
        if($form->isSubmitted() && $form->isValid())
        {
            $formUser = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $registrationFields = $request->request->get('registration');

            $formUser->setPassword($passwordEncoder->encodePassword(
                $formUser,
                $registrationFields['password']
                ));
            $formUser->setRegistrationDate(new \DateTime('now'));

            $em->persist($formUser);
            $em->flush();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            );

        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors
        ]);
    }
}
