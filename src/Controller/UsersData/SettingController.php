<?php


namespace App\Controller\UsersData;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends AbstractController
{
    /**
     * @Route("/settings", name="settings")
     */
    public function index()
    {
        $auth_checker = $this->get('security.authorization_checker');
        if($auth_checker->isGranted('ROLE_USER')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            return $this->render('settings/index.html.twig', [
                'controller_name' => 'SettingController',
                'user' => $user
            ]);
        }
        else
            return $this->redirectToRoute("app_login");
    }
}