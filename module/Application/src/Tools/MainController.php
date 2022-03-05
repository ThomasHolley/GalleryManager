<?php

namespace Application\Tools;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Laminas\Mvc\Controller\AbstractActionController;

class MainController extends AbstractActionController {

    protected EntityManager $entityManager;

    public function __construct(){
        $this->entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, '../../../../bootstrap.php']);
    }

    public function getRepository(string $class): EntityRepository {
        return $this->entityManager->getRepository($class);
    }
}