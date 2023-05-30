<?php
class RecipeController extends Controller
{
    public function homePage()
    {
        $model = new RecipeModel();
        $datas = $model->getAllRecipes();
        self::setRender('homePage.html.twig', ['recipes' => $datas]);
    }

    public function getOne(int $id_recipe)
    {
        $model = new RecipeModel();
        $recipe = $model->getOneRecipe($id_recipe);
        self::setRender('OneRecipe.html.twig', ['recipe' => $recipe]);
    }

    // public function addRecipe()
    // {
    //     global $router;

    //     if (!isset($_SESSION['id'])) {
    //         header('Location: ' . $router->generate('baseRegistrationInscription'));
    //         exit;
    //     }

    //     if (!$_POST) {
    //         self::setRender('addrecipe.html.twig', []);
    //     } else {
    //         if (isset($_POST['submit'])) {
    //             $title = $_POST['title'];
    //             $duration = $_POST['duration'];
    //             $content = $_POST['content'];
    //             $slug = $_POST['slug'];
    //             $thumbnail = $_POST['thumbnail'];
    //             $author = $_SESSION['id'];

    //             if (!empty($content)) {
    //                 $recipe = new Recipes([
    //                     'title' => $title,
    //                     'duration' => $duration,
    //                     'content' => $content,
    //                     'slug' => $slug,
    //                     'thumbnail' => $thumbnail,
    //                     'userid' => $author,
    //                 ]);

    //                 $model = new RecipeModel();
    //                 $model->addRecipe($recipe);
    //                 header('Location: ' . $router->generate('account'));
    //                 exit;
    //             } else {
    //                 echo 'Le champ contenu est vide.';
    //             }
    //         } else {
    //             echo 'Pas marché, réessaye donc encore une fois';
    //         }
    //     }
    // }

    public function deleteRecipe($recipeId)
    {
        global $router;

        $recipeModel = new RecipeModel();
        $result = $recipeModel->getDeleteRecipe($recipeId);

        if ($result['success']) {
            header('Location: ' . $router->generate('home'));
            exit();
        } else {
            echo 'Erreur lors de la suppression de la recette.';
            header('Refresh: 3; URL=' . $router->generate('account'));
            exit();
        }
    }

    public function editRecipe(int $id_recipe)
    {
        global $router;
        $model = new RecipeModel();
        $recipeModel = new RecipeModel();

        if (!$_POST) {
            $editRecipe = $model->getOneRecipe($id_recipe);
            self::setRender('edit.html.twig', ['recipe' => $editRecipe]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? null;
            $slug = $_POST['slug'] ?? null;
            $duration = $_POST['duration'] ?? null;
            $content = $_POST['content'] ?? null;

            if ($title && $slug && $duration && $content) {
                $recipe = new Recipes([
                    'id_recipes' => $id_recipe,
                    'title' => $title,
                    'slug' => $slug,
                    'duration' => $duration,
                    'content' => $content
                ]);

                $recipeModel->editRecipe($recipe);

                // Rediriger vers la page du compte utilisateur
                header('Location: ' . $router->generate('account'));
                exit();
            } else {
                $editRecipe = $model->getOneRecipe($id_recipe);
                self::setRender('edit.html.twig', ['recipe' => $editRecipe, 'error' => 'Veuillez remplir tous les champs obligatoires.']);
                return;
            }
        } else {
            echo 'Erreur lors de la requête.';
            // Rediriger vers la page d'erreur
            header('Location: ' . $router->generate('error'));
            exit();
        }
    }



    public function addRecipe()
    {
        global $router;
        $model = new RecipeModel();
        $modelIngredient = new IngredientsModel();

        if (!isset($_SESSION['id'])) {
            header('Location: ' . $router->generate('baseRegistrationInscription'));
            exit;
        }

        if (!$_POST) {
            self::setRender('addrecipe.html.twig', []);
        } else {
            if (isset($_POST['submit'])) {
                $title = $_POST['title'];
                $duration = $_POST['duration'];
                $content = $_POST['content'];
                $slug = $_POST['slug'];
                $thumbnail = $_POST['thumbnail'];
                $author = $_SESSION['id'];

                if (!empty($content)) {
                    // Créez ici un tableau d'ingrédients en utilisant les valeurs du formulaire
                    $ingredients = [];
                    for ($i = 1; $i <= 5; $i++) {
                        $ingredientName = $_POST['ingredient' . $i];
                        $ingredientQuantity = $_POST['quantity' . $i];
                        if (!empty($ingredientName) && !empty($ingredientQuantity)) {
                            $ingredient = $modelIngredient->getIngredientByName($ingredientName);
                            if ($ingredient) {
                                $ingredients[] = [
                                    'id' => $ingredient->getId(),
                                    'name' => $ingredient->getName(),
                                    'quantity' => $ingredientQuantity
                                ];
                            } else {
                                // Si l'ingrédient n'existe pas, vous pouvez le créer et récupérer son nouvel ID ici
                                // Puis ajoutez-le au tableau d'ingrédients

                                $newIngredientId = $modelIngredient->createIngredient($ingredientName);
                                $ingredients[] = [
                                    'id' => $newIngredientId,
                                    'name' => $ingredientName,
                                    'quantity' => $ingredientQuantity
                                ];
                            }
                        }
                    }

                    // Créez un nouvel objet Recipe avec les données du formulaire
                    $recipe = new Recipes([
                        'title' => $title,
                        'duration' => $duration,
                        'content' => $content,
                        'slug' => $slug,
                        'thumbnail' => $thumbnail,
                        'userid' => $author,
                        'ingredients' => $ingredients
                    ]);

                    $model->addRecipe($recipe);
                    header('Location: ' . $router->generate('account'));
                    exit;
                } else {
                    echo 'Le champ contenu est vide.';
                }
            } else {
                echo 'Pas marché, réessaye donc encore une fois';
            }
        }
    }
}
