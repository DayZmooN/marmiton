<?php
class UserController extends Controller
{
    public function registrationPage()
    {
        // session_start();
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
                    // Vérifier si l'e-mail existe déjà
                    if ($model->checkEmailExists($email)) {
                        $message = "L'e-mail existe déjà. Veuillez choisir un autre e-mail.";
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
                                // Rediriger l'utilisateur vers la page d'accueil
                                $_SESSION['id'] = $result['id'];
                                $_SESSION['email'] = $result['email'];
                                $_SESSION['connect'] = true;
                                header('Location: ' . $router->generate('home'));
                                exit();
                            } else {
                                // Afficher le message d'erreur
                                $message = $result['message'];
                            }
                        }
                    }
                }
            }
        } else {
            $message = '';
        }

        // Afficher le formulaire
        $linkregistation = $router->generate('baseRegistrationInscription');
        echo self::getRender('inscription.html.twig', ['linkregistation' => $linkregistation, 'message' => $message]);
    }



    public function login()
    {
        // session_start();
        global $router;

        if (!$_POST) {
            echo self::getRender('inscription.html.twig', []);
            return;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $model = new UserModel();
        $user = $model->getOneUserByMail($email);

        if (isset($_SESSION['connect']) && $_SESSION['connect'] === true) {
            // Si l'utilisateur est déjà connecté, le rediriger vers la page d'accueil
            header('Location: ' . $router->generate('home'));
            return;
        }

        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['id'] = $user->getId();
            $_SESSION['email'] = $user->getUsername();
            $_SESSION['connect'] = true;
            // var_dump($user);
            $linkconnection = $router->generate('login');
            echo self::getRender('homePage.html.twig', ['connectionPage' => $linkconnection]);
        } else {
            $message = "Email / mot de passe incorrect !";
            echo self::getRender('inscription.html.twig', ['message' => $message]);
            return;
        }
    }

    public function logout()
    {
        // session_start();
        if ($_SESSION['connect'] = true) {
            global  $router;
            session_destroy(); // Détruire la session

            header('Location: ' . $router->generate('home'));
        }
    }


    public function account()
    {

        if ($_SESSION['connect']) {
            $userId = $_SESSION['id'];

            $model = new UserModel();
            $userRecipes = $model->getUserRecipes($userId);

            echo self::getRender('account.html.twig', ['userRecipes' => $userRecipes]);
        } else {
            // Redirect to login page if not logged in
            global $router;
            header('Location: ' . $router->generate('login'));
            exit();
        }
    }
}
