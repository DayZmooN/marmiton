<?php
class RecipeController extends Controller
{

    public function homePage()
    {
        global $router;
        $model = new RecipeModel();
        $datas = $model->getAllRecipes();
        $twig = $this->getTwig();
        //sert a debug ton twig
        // $twig->addExtension(new \Twig\Extension\DebugExtension());
        // var_dump($datas);
        $link = $router->generate('baseRecette');
        $linkRegistration = $router->generate('baseRegistration');
        $linkconnection = $router->generate('connectionPage');
        echo $twig->render('homePage.html.twig', ['recipes' => $datas, 'link' => $link, 'linkRegistration' => $linkRegistration, 'linkConnection' => $linkconnection]);
    }

    public function getOne(int $id_recipe)
    {
        global $router;
        $model = new RecipeModel();
        $recipe = $model->getOneRecipe($id_recipe);
        $twig = $this->getTwig();
        $OneRecipe = $router->generate('recette');
        $linkRegistration = $router->generate('baseRegistration');
        echo $twig->render('OneRecipe.html.twig', ['recipe' => $recipe, 'OneRecipe' => $OneRecipe, 'linkRegistration' => $linkRegistration]);
    }
}
