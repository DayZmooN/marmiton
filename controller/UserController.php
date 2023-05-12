<?php
class UserController extends Controller
{
    public function registrationPage()
    {
        global $router;
        $model = new UserModel();
        $datas = $model->getAddUser();

        // Utilisez les données insérées, si nécessaire
        $id = $datas['id'];
        $username = $datas['username'];
        $email = $datas['email'];

        $twig = $this->getTwig();
        $link = $router->generate('baseRegistrationInscription');
        echo $twig->render('inscription.html.twig', ['link' => $link, 'datas' => $datas, 'username' => $username, 'email' => $email]);
    }
}
