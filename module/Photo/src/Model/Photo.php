<?php

namespace Photo\Model;

use Application\Model\User;
use Galerie\Model\Galerie;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="photo")
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;
    /**
     * @ORM\Column(name="path", type="string")
     */
    private $path;

    /**
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="photos")
     */
    private $user;

    /**
     * @var Galerie
     * @ORM\ManyToOne(targetEntity=Galerie::class, inversedBy="photos")
     */
    private $galerie;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }


}