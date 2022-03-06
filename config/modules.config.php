<?php

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Security',
    'Laminas\Session',
    'Laminas\Db',
    'Laminas\Hydrator',
    'Laminas\Router',

    //Forms
    'Laminas\Form',
    'Laminas\InputFilter',
    'Laminas\Filter',
    'Laminas\Validator',
    'Laminas\I18n',

    //Modules
    'Laminas\ZendFrameworkBridge',
    'Application',
    'Photo',
    'Commande',
    'Galerie'
];
