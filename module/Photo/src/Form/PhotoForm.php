<?php

namespace Photo\Form;

use Laminas\Form\Form;

class PhotoForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('photo');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Titre',
            ],
        ]);
        $this->add([
            'name' => 'description',
            'type' => 'textarea',
            'options' => [
                'label' => 'Description',
            ],
        ]);
        $this->add([
            'name' => 'picture',
            'type' => 'file',
            'options' => [
                'label' => 'Télécharger un fichier'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Ajouter',
                'id' => 'submitbutton',
            ],
        ]);
    }
}