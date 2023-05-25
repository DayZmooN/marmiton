<?php
class CategorieController extends Controller
{
    public function getOne($id)
    {
        global $router;
        $model = new CategorieModel();
        $category = $model->getOneCategorie($id);
        $recipes = $model->getRecipesByCategorie($id);
        $link7 = $router->generate('recette');

        echo self::getRender('categories.html.twig', ['category' => $category, 'recipes' => $recipes, 'link7' => $link7]);
    }
}
