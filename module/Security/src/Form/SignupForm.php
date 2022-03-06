<?php

namespace Security\Form;

use Laminas\Form\Form;

class SignupForm extends Form
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct('signup', $options);

        $this->add([
            'name' => 'nom',
            'type' => 'text',
            'options' => [
                'label' => 'Nom',
            ],
        ]);

        $this->add([
            'name' => 'prenom',
            'type' => 'text',
            'options' => [
                'label' => 'Prénom',
            ],
        ]);

        $this->add([
            'name' => 'email',
            'type' => 'email',
            'options' => [
                'label' => 'Email',
            ],
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'Mot de passe',
            ],
        ]);

        $this->add([
            'name' => 'confirmPassword',
            'type' => 'password',
            'options' => [
                'label' => 'Confirmez le mot de passe',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Valider',
                'id' => 'submitbutton',
            ],
        ]);

    }
}