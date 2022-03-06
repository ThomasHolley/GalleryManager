<?php

declare(strict_types=1);

namespace Security\Controller;

use Application\Model\User;
use Application\Tools\Auth\AuthConstants;
use Application\Tools\MainController;
use Laminas\View\Model\ViewModel;
use Security\Form\LoginForm;
use Security\Form\SignupForm;

/**
 *
 * This file has been generated with LaminasGen
 * https://github.com/ThomasLeconte/laminas-gen
 *
 */
class AuthController extends MainController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function signupAction(){
        $form = new SignupForm();
        $request = $this->getRequest();
        if(!$request->isPost()){
            return [ "form" => $form ];
        }else{
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if(!$form->isValid()){
                return [ "form" => $form ];
            }else{
                $user->setNom($form->get('nom')->getValue());
                $user->setPrenom($form->get('prenom')->getValue());
                $user->setEmail($form->get('email')->getValue());
                $user->setPassword(password_hash($form->get('password')->getValue(), PASSWORD_BCRYPT));
                $user->setRole(AuthConstants::ROLE_USER);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $this->redirect()->toRoute("home");
            }
        }
    }

    public function loginAction(){
        if($this->isAuthenticated()){
            $this->redirect()->toRoute("home");
        }
        $form = new LoginForm();
        $request = $this->getRequest();
        if(!$request->isPost()){
            return ["form" => $form];
        }else{
            $form->setData($request->getPost());
            if(!$form->isValid()){
                return ["form" => $form];
            }else{
                $this->authIsValid($form);
            }
        }
    }

    public function logoutAction(){
        if($this->isAuthenticated()){
            unset($this->sessionManager->getStorage()->user);
        }
        $this->redirect()->toRoute("home");
    }

    private function authIsValid(LoginForm $form){
        $user = $this->getRepository(User::class)->findOneBy(["email" => $form->get('email')->getValue()]);
        if($user != null){
            if(password_verify($form->get('password')->getValue(), $user->getPassword())){
                $this->setSessionProperty("user", $user);
                $this->redirect()->toRoute("home");
            }else{
                return ["form" => $form];
            }
        }
    }
}
