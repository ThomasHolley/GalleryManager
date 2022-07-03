<?php

declare(strict_types=1);

namespace Commande\Controller;

use Application\Tools\MainController;
use Commande\Model\Commande;
use Laminas\View\Model\ViewModel;


class CommandeController extends MainController
{
    public function indexAction()
    {
        return new ViewModel();
    }


    public function addAction()
    {
        $commande = new Commande();
        $commande->setUser($this->sessionValue("user"));
        $commande->setGalerie("id");
        $this->entityManager->persist($commande);
        $this->entityManager->flush();
        $this->redirect()->toUrl("/commande");
        return new ViewModel();
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
