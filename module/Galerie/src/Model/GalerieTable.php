<?php

namespace Galerie\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;

class GalerieTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
}