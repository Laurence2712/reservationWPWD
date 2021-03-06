<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Form\Forms;
use App\Repository\RoleRepository;
use Symfony\Component\Form\FormView;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        /*if ($this->getUser()) {
             return $this->redirectToRoute('target_path');
         }*/

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
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');



    }

    /**
     * @Route("/signin", name="app_signin")
     */
    public function register(RoleRepository $repository, Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, ValidatorInterface $validator): Response{


      //Si l'utilisateur est connecté, on le redirige
      $user = $this->getUser();
      /*if($user){
        return $this->redirectRoute('show');
      }

*/
        $title = 'Inscription';
        $user = new User();
        $errors = [];
        

        $role = $repository->findBy(['role'=> 'ROLE_MEMBER']);
        //dd($role[0]);
        //$roleAdmin = new Role();
       // $roleAdmin->getRole('ROLE_MEMBER');
        $user->addRole($role[0]);
        

        $form = $this->createForm(UserType::class,$user);
        $form->remove('password');

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
          $user = $form->getData();
         
          $user->setPassword($form->get('plainPassword')->getData());

          //$userRole = $form->get('user_role')->getData();
          //$user->addRole($userRole);

          $errors = $validator->validate($user);

          if(count($errors)==0) {
              //Hashage du mot de passe
              $user->setPassword(
                  $passwordEncoder->encodePassword(
                      $user,
                      $form->get('plainPassword')->getData()
                  )
              );

              $entityManager = $this->getDoctrine()->getManager(); 
              $entityManager->persist($user);
              $entityManager->flush();//dd($user);

              // do anything else you need here, like send an email

              return $guardHandler->authenticateUserAndHandleSuccess(
                  $user,
                  $request,
                  $authenticator,
                  'main' // firewall name in security.yaml
              );
          }
        }

        return $this->render('security/signin.html.twig',[
            'title' => $title,
            'formRegister' => $form->createView(),
            'errors' => $errors,

        ]);
    }
}
