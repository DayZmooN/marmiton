<?php
class PostController extends Controller
{
    // private function getTwig()
    // {
    //     $loader = new \Twig\Loader\FilesystemLoader('./view');

    //     return new \Twig\Environment($loader, [
    //         'cache' => false,
    //     ]);
    // }

    public function homePage()
    {
        global $router;
        $model = new PostModel();
        $datas = $model->getAllRecipes();

        $twig = $this->getTwig();

        // Activer la compression Gzip
        // ob_start("ob_gzhandler");

        //sert a debug ton twig
        // $twig->addExtension(new \Twig\Extension\DebugExtension());
        // var_dump($datas);
        echo $twig->render('homePage.html.twig', ['recipes' => $datas]);


        // Fin de la compression
        // ob_end_flush();
    }

    public function getOne(int $id)
    {
        $model = new PostModel();
        $recipe = $model->getOneRecipe($id);
        $twig = $this->getTwig();

        // Activer la compression Gzip
        ob_start("ob_gzhandler");

        echo $twig->render('onePost.html.twig', ['recipe' => $recipe]);

        // Envoyer les en-têtes pour la compression Gzip
        header('Content-Encoding: gzip');
        header('Vary: Accept-Encoding');

        // Fin de la compression
        ob_end_flush();
    }
}
