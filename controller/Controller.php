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
            self::$twig->addGlobal('session', $_SESSION);
            self::$twig->addGlobal('get', $_GET);

            self::$twig->addFunction(new \Twig\TwigFunction('path', function ($routeName) {
                global $router;
                return $router->generate($routeName);
            }));
        }
        return self::$twig;
    }

    protected static function setRender(string $template, $datas)
    {
        global $router;

        $link = $router->generate('baseRecette');
        $link7 = $router->generate('recette');
        // CATEGORIES
        $link2 = $router->generate('categories');
        $categories = new CategorieModel();
        $cats = $categories->getAllCategories();
        // Inscription
        $link3 = $router->generate('baseRegistrationInscription');



        // Déconnexion
        $link4 = $router->generate('logout');

        //create recipe
        $link5 = $router->generate('addRecipe');

        //categorie header
        $link6 = $router->generate('baseRecetteCategorie');

        // Création d'un nouveau tableau avec les données nécessaires
        $new = [
            'link' => $link,
            'cats' => $cats,
            'link2' => $link2,
            'link3' => $link3,
            'link4' => $link4,
            'link5' => $link5,
            'link6' => $link6,
            'link7' => $link7
        ] + $datas;

        // Rendu du template en utilisant Twig
        echo self::getTwig()->render($template, $new);
    }

    protected static function getRender($template, $datas)
    {
        if (self::$render === null) {
            self::setRender($template, $datas);
        }
        return self::$render;
    }
}
