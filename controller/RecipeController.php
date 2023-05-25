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


    public function addRecipe()
    {
        global $router;

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['id'])) {
            header('Location: ' . $router->generate('baseRegistrationInscription'));
            exit;
        }

        if (!$_POST) {
            echo self::getRender('addrecipe.html.twig', []);
        } else {
            if (isset($_POST['submit'])) {
                $title = $_POST['title'];
                $duration = $_POST['duration'];
                $content = $_POST['content'];
                $slug = $_POST['slug'];
                $thumbnail = $_POST['thumbnail'];
                $author = $_SESSION['id'];

                // Vérifier si le champ 'content' n'est pas vide
                if (!empty($content)) {
                    $recipe = new Recipes([
                        'title' => $title,
                        'duration' => $duration,
                        'content' => $content,
                        'slug' => $slug,
                        'thumbnail' => $thumbnail,
                        'userid' => $author,
                    ]);

                    $model = new RecipeModel();
                    $model->addRecipe($recipe);
                    header('Location: ' . $router->generate('home'));
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
