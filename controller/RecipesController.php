<?php
class RecipeController extends Controller
{

    public function homePage()
    {
        global $router;
        $model = new RecipeModel();
        $datas = $model->getAllRecipes();
        $twig = $this->getTwig();
        // Activer la compression Gzip
        ob_start("ob_gzhandler");

        //sert a debug ton twig
        // $twig->addExtension(new \Twig\Extension\DebugExtension());
        // var_dump($datas);
        $link = $router->generate('baseRecette');
        $linkRegistration = $router->generate('baseRegistration');
        echo $twig->render('homePage.html.twig', ['recipes' => $datas, 'link' => $link, 'linkRegistration' => $linkRegistration]);


        // Fin de la compression
        ob_end_flush();
    }

    public function getOne(int $id_recipe)
    {
        global $router;
        $model = new RecipeModel();
        $recipe = $model->getOneRecipe($id_recipe);
        $twig = $this->getTwig();
        $OneRecipe = $router->generate('recette');
        // Activer la compression Gzip
        ob_start("ob_gzhandler");
        echo $twig->render('OneRecipe.html.twig', ['recipe' => $recipe, 'OneRecipe' => $OneRecipe]);

        // Envoyer les en-têtes pour la compression Gzip
        header('Content-Encoding: gzip');
        header('Vary: Accept-Encoding');

        // Fin de la compression
        ob_end_flush();
    }
}
