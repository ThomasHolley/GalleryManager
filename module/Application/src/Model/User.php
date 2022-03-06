<?php

namespace Application\Model;

use Commande\Model\Commande;
use Doctrine\ORM\Mapping as ORM;
use Galerie\Model\Galerie;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\StringLength;
use Photo\Model\Photo;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * This file has been generated with LaminasGen
 * https://github.com/ThomasLeconte/laminas-gen
 *
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;
    /**
     * @ORM\Column(name="nom", type="string")
     */
    private $nom;
    /**
     * @ORM\Column(name="prenom", type="string")
     */
    private $prenom;
    /**
     * @ORM\Column(name="email", type="string")
     */
    private $email;
    /**
     * @ORM\Column(name="password", type="string")
     */
    private $password;
    /**
     * @ORM\Column(name="role", type="string")
     */
    private $role;

    /**
     * @var Photo[]
     * @ORM\OneToMany(targetEntity=Photo::class, cascade={"persist", "remove"}, mappedBy="user")
     */
    private $photos;

    /**
     * @var Galerie[]
     * @ORM\OneToMany(targetEntity=Galerie::class, cascade={"persist", "remove"}, mappedBy="user")
     */
    private $galeries;

    /**
     * @var Commande[]
     * @ORM\OneToMany(targetEntity=Commande::class, cascade={"persist", "remove"}, mappedBy="user")
     */
    private $commandes;

    /**
     * @var User[]
     * @ORM\JoinTable(name="user_contacts",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="contact_id", referencedColumnName="id")}
     *      )
     */
    private $contacts;

    public function __construct()
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($value)
    {
        $this->nom = $value;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($value)
    {
        $this->prenom = $value;
    }

    public function getFullName()
    {
        return $this->nom . " " . $this->prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($value)
    {
        $this->role = $value;
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'nom',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'prenom',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'password',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                [
                    'name' => \Laminas\Validator\Identical::class,
                    'options' => [
                        'token' => 'confirmPassword',
                        'message' => "Les mots de passe doivent être identique !"
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'confirmPassword',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => \Laminas\Validator\Identical::class,
                    'options' => [
                        'token' => 'password',
                        'message' => "Les mots de passe doivent être identique !"
                    ],
                ],
            ],
        ]);
        return $inputFilter;
    }
}