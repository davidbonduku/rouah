<?php

/**
 * CONFIGURATIONS DE L'APPLICATION
 */
    BDDConnexion::config(array(
        'host' => 'localhost',
        'dbname' => 'bddMusique',
        'username' => 'root',
        'password' => 'root',
        'debug' => true
    ));

    Application::config(array(
        'mode' => 'production',
        'debug' => true
    ));
