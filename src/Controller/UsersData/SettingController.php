<?php


namespace App\Controller\UsersData;


use App\Form\AuthType;
use App\Form\SettingsType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SettingController extends AbstractController
{
    /**
     * @Route("/settings", name="settings")
     * @param Request $request
     * @return Response
     */
    public function editData(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
            $user = $this->getUser();
            $settingsForm = $this->createForm(SettingsType::class);
            $settingsForm->createView();
            $settingsForm->handleRequest($request);
            if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $settingsFields = $request->request->get('settings');
                $user = $this->UpdateUserData($settingsFields, $passwordEncoder);
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute("home");
            }
            return $this->render('settings/index.html.twig', [
                'controller_name' => 'SettingController',
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'settingsForm' => $settingsForm
            ]);
    }
    private function UpdateUserData($fields, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getUser();
        $firstNameField = $fields['firstName'];
        if($firstNameField != $user->getFirstName())
            $user->setFirstName($firstNameField);
        $lastNameField =  $fields['lastName'];
        if($lastNameField != $user->getLastName())
            $user->setLastName($lastNameField);
        $emailField = $fields['email'];
        if($emailField != $user->getEmail())
            $user->setEmail($emailField);
        if($fields['password']['first'] != null)
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $fields['password']['first']
            ));

        return $user;
    }
}