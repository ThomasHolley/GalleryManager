<?php

namespace Application\Tools;

use Application\Model\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\SessionManager;
use Laminas\Session\Storage\ArrayStorage;
use Laminas\Session\Storage\SessionArrayStorage;

class MainController extends AbstractActionController {

    protected EntityManager $entityManager;
    protected SessionManager $sessionManager;

    public function __construct(){
        $this->entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, '../../../../bootstrap.php']);

        $this->sessionManager = new SessionManager();
        $this->setSessionProperty("user", $this->getRepository(User::class)->findOneBy(["nom" => "Leconte"]));
    }

    public function getRepository(string $class): EntityRepository {
        return $this->entityManager->getRepository($class);
    }

    /**
     * Clean session content and set $content instead
     * $this->updateSession(["user" => "toto"]);
     * @param array $content
     */
    public function updateSession(array $content){
        $this->sessionManager->setStorage(new ArrayStorage($content));
    }

    /**
     * Add property to current session
     * @param $key
     * @param $value
     */
    public function setSessionProperty($key, $value){
        $this->sessionManager->getStorage()->$key = $value;
    }

    /**
     * Return value of session key
     * @param $key
     * @return mixed
     */
    public function sessionValue($key){
        return $this->sessionManager->getStorage()->$key;
    }
}