<?php

namespace App\Controller;

use App\Form\PasswordSetFormType;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/user/set-new-password", name="user_set-new-password", requirements={"invoiceId"="\d+"})
    */
    public function setNewPassword(int $userId, Request $request): Response
    {
        //TODO: create simple form for changing password
        // user/admin should know his password, so three password input fields
        // 1. old password
        // 2. new password
        // 3. retype new password


        $form = $this->createForm(PasswordSetFormType::class);

        return $this->render('security/passwordSet.html.twig',[
            'form' => $form->createView(),
            'customPageTitle' => 'Set password'
        ]);

    }
}
