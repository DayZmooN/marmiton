<?php
// inclusion de la classe Twig_Autoloader
require_once 'vendor/autoload.php';

// chargement des vues Twig
$loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/view');

// initialisation de l'environnement Twig
$twig = new Twig\Environment($loader);

// définition de la fonction asset
$function = new Twig\TwigFunction('asset', function ($asset, $type = 'absolute') {
    if ($type == 'absolute') {
        return sprintf('%s/%s?v=%s', $_SERVER['APP_URL'], ltrim($asset, '/'), $_SERVER['APP_VERSION']);
    } elseif ($type == 'cdn') {
        return sprintf('%s/%s?v=%s', $_SERVER['APP_CDN_URL'], ltrim($asset, '/'), $_SERVER['APP_VERSION']);
    } else {
        throw new \Exception('Invalid asset type');
    }
});

// ajout de la fonction asset à Twig
$twig->addFunction($function);
