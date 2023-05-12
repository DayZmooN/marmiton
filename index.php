<?php

// inclusion du fichier config.php
// require_once './config/config.php';

// Chargement des dépendances
// Chargement de l'autoloader de Composer
require_once './vendor/altorouter/altorouter/AltoRouter.php'; // Chargement de la classe AltoRouter
require_once './vendor/autoload.php';
// Création de l'objet router
$router = new AltoRouter();

// Configuration du chemin de base 
$router->setBasePath('/php/marmiton'); // Chemin de base pour les URL

// Mappage des routes avec les actions du contrôleur
$router->map('GET', '/', 'RecipeController#homePage', 'home'); // Page d'accueil
$router->map('GET', '/recette/', '', 'baseRecette');
$router->map('GET', '/recette/[i:id_recipe]', 'RecipeController#getOne', 'recette'); // Article unique par ID


$router->map('GET', '/recette/inscription', 'UserController#registrationPage',  'baseRegistration');

//envoi de donner inscription
$router->map('POST', '/recette/', 'baseRegistrationInscription');
$router->map('POST', '/inscription ', 'UserController#registrationPage', 'baseRegistrationInscription');






// Recherche de la route correspondante
$match = $router->match(); // Vérification de la route demandée par l'utilisateur

//regarder si sa match

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller(); // Instanciation de l'objet contrôleur

    if (is_callable(array($obj, $action))) { // Vérification de l'existence de la méthode d'action
        call_user_func_array(array($obj, $action), $match['params']); // Exécution de la méthode d'action avec les paramètres requis
    }
}
