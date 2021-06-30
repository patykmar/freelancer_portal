<?php

namespace App\Controller;

use App\Controller\Admin\UserCrudController;
use App\Form\PasswordSetFormType;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use DateTime;

class SecurityController extends AbstractController
{
    private AdminUrlGenerator $adminUrlGenerator;
    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $encoder;

    /**
     * SecurityController constructor.
     * @param AdminUrlGenerator $adminUrlGenerator
     * @param UserRepository $userRepository
     */
    public function __construct(AdminUrlGenerator $adminUrlGenerator, UserRepository $userRepository, UserPasswordEncoderInterface $encoder)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
    }

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

        // generate URL to EasyAdmin controller
        $destinationUrl = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->setAction(Crud::PAGE_INDEX);

        // check if user is in DB
        $userFromDb = $this->userRepository->find($userId);
        if (is_null($userId)) {
            $this->addFlash('error', 'User with this ID is not in database!');
            return $this->redirect($destinationUrl);
        }

        $form = $this->createForm(PasswordSetFormType::class);
        $form->get('user-id')->setData($userId);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();

            $newEncodedPassword = $this->encoder->encodePassword(
                $userFromDb,
                $formData['new-password']
            );
            $userFromDb->setPasswordChanged(new DateTime());
            $this->userRepository->upgradePassword($userFromDb, $newEncodedPassword);

            $this->addFlash('notice', 'New password for user '.$userFromDb->getUsername().' has been changed.');
            return $this->redirect($destinationUrl);
        }

        return $this->render('security/passwordSet.html.twig', [
            'form' => $form->createView(),
            'customPageTitle' => 'Set new password for user: '.$userFromDb->__toString()
        ]);

    }
}
