<?php

declare(strict_types=1);

namespace Galerie\Controller;

use Application\Tools\MainController;
use Galerie\Form\GalerieForm;
use Galerie\Model\Galerie;
use Laminas\View\Model\ViewModel;

/**
 *
 * This file has been generated with LaminasGen
 * https://github.com/ThomasLeconte/laminas-gen
 *
 */
class GalerieController extends MainController
{
    public function indexAction()
    {
        if ($this->isAuthenticated()) {
            return [
                'galeries' => $this->getRepository(Galerie::class)->findBy(["user" => $this->sessionValue("user")])
            ];
        } else {
            return $this->notAuthenticatedPage();
        }
    }

    public function addAction()
    {
        $form = new GalerieForm();
        $request = $this->getRequest();
        if ($request->isGet()) {
            return ["form" => $form];
        } else {
            $galerie = new Galerie();
            $form->setInputFilter($galerie->getInputFilter());
            $form->setData($request->getPost());
            if (!$form->isValid()) {
                return ["form" => $form];
            } else {
                $galerie->setNom($form->get("nom")->getValue());
                $galerie->setDescription($form->get("description")->getValue());
                $galerie->setUser($this->sessionValue("user"));
                $galerie->setCreated(new \DateTime());
                $galerie->setUpdated(new \DateTime());
                $this->entityManager->persist($galerie);
                $this->entityManager->flush();
                $this->redirect()->toUrl("/galerie");
            }
        }
    }

    public function editAction()
    {
        return new ViewModel();
    }

    public function deleteAction()
    {
        return new ViewModel();
    }
}
