<?php


namespace App\Controller\UsersData;

use App\Form\SettingsType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SettingController extends AbstractController
{
    /**
     * @Route("/settings", name="settings")
     * @param Request $request
     * @return Response
     */
    public function editData(Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        if ((isset($_SESSION['display_settings']) && $_SESSION['display_settings'] === TRUE) || !empty($request->request->all())) {
            unset($_SESSION['display_settings']);
            /** @var User $user */
            $user = $this->getUser();
            $settingsForm = $this->createForm(SettingsType::class);
            $settingsForm->createView();
            $settingsForm->handleRequest($request);
            if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $settingsFields = $request->request->get('settings');
                $user = $this->UpdateUserData($settingsFields, $passwordHasher);
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
        } else {
            return $this->redirectToRoute("auth");
        }
    }

    private function UpdateUserData($fields, UserPasswordHasherInterface $passwordHasher)
    {
        /** @var User $user */
        $user = $this->getUser();
        $firstNameField = $fields['firstName'];
        if ($firstNameField != $user->getFirstName())
            $user->setFirstName($firstNameField);
        $lastNameField = $fields['lastName'];
        if ($lastNameField != $user->getLastName())
            $user->setLastName($lastNameField);
        $emailField = $fields['email'];
        if ($emailField != $user->getEmail())
            $user->setEmail($emailField);
        if ($fields['password']['first'] != null)
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $fields['password']['first']
                )
            );

        return $user;
    }
}