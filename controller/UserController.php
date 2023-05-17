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
        echo $twig->render('inscription.html.twig', ['link' => $link]);
    }


    public function connection()
    {
        session_start();

        $message = '';

        if (isset($_POST['email'], $_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            global $router;
            $model = new UserModel();
            $user = $model->checkLogin($email, $password);
            if ($user) {
                $_SESSION['id'] = $user->getId();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['connect'] = true;
                header('Location: ./');
                exit();
            } else {
                header('Location: ');
                $message = "L'adresse email ou le mot de passe est incorrect.";
            }
        }

        // Afficher le formulaire de connexion
        $twig = $this->getTwig();
        $linkconnection = $router->generate('connectionPage');
        echo $twig->render('homePage.twig', ['link' => $linkconnection, 'message' => $message]);
    }
}
