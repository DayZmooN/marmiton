<?php
class UserController extends Controller
{
    public function registrationPage()
    {
        global $router;
        $model = new UserModel();

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier si tous les champs sont remplis
            if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                $message = "Veuillez remplir tous les champs du formulaire.";
            } else {
                // Récupérer les données du formulaire
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Vérifier si l'adresse email est valide
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $message = "L'adresse email n'est pas valide.";
                } else {
                    // Vérifier si le mot de passe respecte les critères de sécurité (par exemple, 8 caractères, au moins une majuscule, une minuscule et un chiffre)
                    if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
                        $message = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
                    } else {
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
                            header('Location: ./');
                            exit();
                        } else {
                            // Afficher le message d'erreur
                            $message = $result['message'];
                        }
                    }
                }
            }
        } else {
            $message = '';
        }

        // Afficher le formulaire
        $twig = $this->getTwig();
        $linkregistation = $router->generate('baseRegistrationInscription');
        echo $twig->render('inscription.html.twig', ['linkregistation' => $linkregistation, 'message' => $message]);
    }



    public function connection()
    {
        session_start();
        if (isset($_SESSION['connect']) && $_SESSION['connect'] === true) {
            // Si l'utilisateur est déjà connecté, le rediriger vers la page d'accueil
            header('Location: ./');
        }

        $message = 'pas bon';

        if (isset($_POST['email'], $_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            global $router;
            $model = new UserModel();
            $user = $model->checkLogin($email, $password);
            var_dump($user);
            if ($user) {
                $_SESSION['id'] = $user->getId();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['connect'] = true;
                exit(); // Retirer la redirection ici pour éviter la redirection après une connexion réussie
            } else {
                $message = "L'adresse email ou le mot de passe est incorrect.";
            }
        }

        // Afficher le formulaire de connexion
        $twig = $this->getTwig();
        $linkconnection = $router->generate('connectionPage');
        $linklogout = $router->generate('logout');
        echo $twig->render('inscription.html.twig', ['link' => $linkconnection, 'logout' => $linklogout, 'message' => $message]);
    }


    public function logout()
    {
        session_start();
        if ($_SESSION['connect'] = true) {
            session_destroy(); // Détruire la session

            header('Location: ./');
        }
    }
}
