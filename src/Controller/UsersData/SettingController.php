<?php


namespace App\Controller\UsersData;


use App\Form\SettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class SettingController extends AbstractController
{
    /**
     * @Route("/settings", name="settings")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $auth_checker = $this->get('security.authorization_checker');
        if($auth_checker->isGranted('ROLE_USER')) {
            $user = $this->getUser();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $email = $user->getEmail();
            $settingsForm = $this->createForm(SettingsType::class, [
                'method' => 'GET'
            ]);
            $settingsForm->handleRequest($request);
            if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $user = $this->UpdateUserData($settingsForm, $passwordEncoder);
                //dd($user);
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute("home");
            }

            return $this->render('settings/index.html.twig', [
                'controller_name' => 'SettingController',
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'settingsForm' => $settingsForm
            ]);
        }
        else
            return $this->redirectToRoute("app_login");
    }
    private function UpdateUserData($settingsForm, UserPasswordEncoderInterface $passwordEncoder){
        $user = $this->getUser();

        $firstNameForm = $settingsForm->get('firstName')->getData();
        if($firstNameForm != $user->getFirstName())
            $user->setFirstName($firstNameForm);
        $lastNameForm = $settingsForm->get('lastName')->getData();
        if($lastNameForm != $user->getLastName())
            $user->setLastName($lastNameForm);
        $emailForm = $settingsForm->get('email')->getData();
        if($emailForm != $user->getEmail())
            $user->setEmail($emailForm);

        if($settingsForm->get('password')->getData() != null)
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $settingsForm->get('password')->getData()
            ));

        return $user;
    }
}