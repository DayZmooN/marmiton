<?php
class IngredientController extends Controller
{
    public function getAllIngredients()
    {
        $model = new IngredientsModel();
        $ingredients = $model->getAllIngredients();

        self::setRender('account.html.twig', ['ingredients' => $ingredients]);
    }
}
