<?php
session_start();
// Chargement des dépendances
// Chargement de l'autoloader de Composer
require_once './vendor/altorouter/altorouter/AltoRouter.php'; // Chargement de la classe AltoRouter
require_once './vendor/autoload.php';
// Création de l'objet router
$router = new AltoRouter();

// Configuration du chemin de base 
$router->setBasePath('/php/marmiton'); // Chemin de base pour les URL

// Mappage des routes avec les actions du contrôleur
$router->map('GET', '/', 'RecipeController#homePage', 'home');

// Page d'accueil
$router->map('GET', '/recette/', '', 'baseRecette');

$router->map('GET', '/recette/[i:id_recipe]', 'RecipeController#getOne', 'recette'); // Article unique par ID

//envoi de donner inscription
$router->map('POST|GET', '/inscription/', 'UserController#registrationPage', 'baseRegistrationInscription');

//connection
// $router->map('POST', '/', 'UserController#connection', 'connectionPage');
$router->map('POST', '/', 'UserController#login', 'login');

//Deconnexion
$router->map('GET', '/logout', 'UserController#logout', 'logout');

//addRecipe
$router->map('GET|POST', '/addRecipe', 'RecipeController#addRecipe', 'addRecipe');

//categories
$router->map('GET', '/categories', '', 'categories');
//recette selon les categorie
$router->map('GET', '/category/[i:id]', 'CategorieController#getOne', 'baseRecetteCategorie');


//searchbar
$router->map('GET', '/search', 'SearchController#searchResult', 'search');

//account
$router->map('GET', '/account', 'UserController#account', 'account');

//delete recipe 
$router->map('GET|POST', '/recipe/delete/[i:recipeId]', 'RecipeController#deleteRecipe', 'deleteRecipe');

//EDIT

// $router->map('GET|POST', '/edit/', 'RecipeController#editRecipe', 'editRecipe');

// $router->map('POST', '/recipe/{id}', 'RecipeController#editRecipe', 'recipe');

// $router->map('GET|POST', '/edit/', 'RecipeController#editRecipe', 'recipe');

$router->map('GET|POST', '/edit/[i:id_recipe]', 'RecipeController#editRecipe', 'editRecipe');

//error
$router->map('GET', '/error', 'ErrorController#error', 'error');





// Recherche de la route correspondante
$match = $router->match(); // Vérification de la route demandée par l'utilisateur
//regarder si sa match
var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller(); // Instanciation de l'objet contrôleur

    if (is_callable(array($obj, $action))) { // Vérification de l'existence de la méthode d'action
        call_user_func_array(array($obj, $action), $match['params']); // Exécution de la méthode d'action avec les paramètres requis
    }
}
