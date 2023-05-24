<?php
class RecipeController extends Controller
{

    public function homePage()
    {
        $model = new RecipeModel();
        $datas = $model->getAllRecipes();
        //sert a debug ton twig
        // $twig->addExtension(new \Twig\Extension\DebugExtension());
        // var_dump($datas);
        echo self::getRender('homePage.html.twig', ['recipes' => $datas]);
    }

    public function getOne(int $id_recipe)
    {
        $model = new RecipeModel();
        $recipe = $model->getOneRecipe($id_recipe);

        echo self::getRender('OneRecipe.html.twig', ['recipe' => $recipe]);
    }
}
