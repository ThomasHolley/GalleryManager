<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Tools\MainController;
use Laminas\View\Model\ViewModel;

class IndexController extends MainController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
