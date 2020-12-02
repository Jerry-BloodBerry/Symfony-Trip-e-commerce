<?php


namespace App\Controller\UsersData;


use App\Form\SettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends AbstractController
{
    /**
     * @Route("/settings", name="settings")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $auth_checker = $this->get('security.authorization_checker');
        if($auth_checker->isGranted('ROLE_USER')) {
            $user = $this->getUser();
            $name = $user->getFirstName();
            $lastName = $user->getLastName();
            $email = $user->getEmail();
            $updatedUser = new User();
            $settingsForm = $this->createForm(SettingsType::class, $updatedUser, [
                'method' => 'GET'
            ]);
            $settingsForm->handleRequest($request);
            if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                //$em->persist($updatedUser);
                //$em->flush();
                return $this->redirectToRoute("home");
            }

            return $this->render('settings/index.html.twig', [
                'controller_name' => 'SettingController',
                'firstName' => $name,
                'lastName' => $lastName,
                'email' => $email,
                'settingsForm' => $settingsForm
            ]);
        }
        else
            return $this->redirectToRoute("app_login");
    }
}