<?php

namespace Commande\Model;

use Application\Model\User;
use Galerie\Model\Galerie;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="commande")
 * This file has been generated with LaminasGen
 * https://github.com/ThomasLeconte/laminas-gen
 *
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
	private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     */
	private $user;

    /**
     * @var Galerie
     * @ORM\ManyToOne(targetEntity=Galerie::class, inversedBy="commandes")
     */
	private $galerie;


	public function getId(){
		return $this->id;
	}

	public function setId($value){
		$this->id = $value;
	}

	public function getUser(){
		return $this->user;
	}

	public function setUser($value){
		$this->user = $value;
	}

	public function getGalerie(){
		return $this->galerie;
	}

	public function setGalerie($value){
		$this->galerie = $value;
	}


}