<?php
class UserController extends Controller
{
    public function registrationPage()
    {
        global $router;
        $model = new UserModel();

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Créer un tableau de données pour la construction de l'objet User
            $userData = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
            ];

            // Créer une instance de User
            $user = new User($userData);

            // Sauvegarder l'utilisateur dans la base de données
            $result = $model->saveUser($user);

            if ($result['success']) {
                // Rediriger l'utilisateur vers une autre page
                header('Location: homePage.html.twig');
                exit();
            } else {
                // Afficher le message d'erreur
                $message = $result['message'];
            }
        }

        // Afficher le formulaire
        $twig = $this->getTwig();
        $link = $router->generate('baseRegistrationInscription');
        $linkconnection = $router->generate('connectionPage');
        echo $twig->render('inscription.html.twig', ['link' => $link, 'connectionPage' => $linkconnection]);
    }

    public function connection()
    {

        // var_dump($_POST['email']);
        if (isset($_POST['email'])) {
            session_start();

            $email = $_POST['email'];
            $password = $_POST['password'];

            $model = new UserModel;
            $userData = $model->checkLogin($email);

            if ($userData) {
                $_SESSION['id'] = $userData['id'];
                $_SESSION['email'] = $userData['email'];
                $_SESSION['connect'] = true;
                $passwordHash = $userData['password'];
                var_dump($userData);

                if (password_verify($password, $passwordHash)) {
                    var_dump($userData);

                    // header('Location: ./');
                }
            }
        }
    }



    // } else {
    //     global $router;
    //     // $linkconnection = $router->generate('connectionPage');
    //     // echo $this->getTwig()->render('connection.html.twig', ['link' => $linkconnection]);
    // }
}
