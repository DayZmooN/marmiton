<?php

abstract class Controller
{
    private static $loader;
    private static $twig;
    private static $render;

    private static function getLoader()
    {
        if (self::$loader === null) {
            self::$loader = new \Twig\Loader\FilesystemLoader('./view');
        }
        return self::$loader;
    }

    protected static function getTwig()
    {
        if (self::$twig === null) {
            $loader = self::getLoader();
            self::$twig = new \Twig\Environment($loader);

            // Ajouter les variables de session au contexte global de Twig
            self::$twig->addGlobal('session', $_SESSION);

            // Ajouter les variables GET au contexte global de Twig
            self::$twig->addGlobal('get', $_GET);

            // Ajouter la fonction "path" à l'environnement Twig
            self::$twig->addFunction(new \Twig\TwigFunction('path', function ($routeName) {
                global $router;
                return $router->generate($routeName);
            }));

            // Ajouter la fonction "asset" à l'environnement Twig
            self::$twig->addFunction(new \Twig\TwigFunction('asset', function ($assetPath) {
                // Modifier cette logique en fonction de la configuration de vos assets
                $basePath = '/projets/marmiton/asset'; // Mettez à jour avec votre chemin de base des assets
                return $basePath . $assetPath;
            }));
        }
        return self::$twig;
    }

    protected static function setRender(string $template, $data)
    {
        global $router;

        $link = $router->generate('baseRecette');
        // $link7 = $router->generate('recette');
        // CATEGORIES
        $link2 = $router->generate('categories');
        $categories = new CategorieModel();
        $cats = $categories->getAllCategories();
        // Inscription
        $link3 = $router->generate('baseRegistrationInscription');

        // Déconnexion
        $link4 = $router->generate('logout');

        // Création d'une nouvelle variable de session pour Twig
        $session = $_SESSION;

        // Création d'un nouveau tableau avec les données nécessaires
        $data = array_merge(
            [
                'link' => $link,
                'cats' => $cats,
                'link2' => $link2,
                'link3' => $link3,
                'link4' => $link4,
                'session' => $session,
            ],
            $data
        );

        // Rendu du template en utilisant Twig
        echo self::getTwig()->render($template, $data);
    }

    protected static function getRender($template, $data)
    {
        if (self::$render === null) {
            self::setRender($template, $data);
        }
        return self::$render;
    }
}
