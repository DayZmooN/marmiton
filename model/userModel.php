<?php

class UserModel extends Model
{

    public function getAddUser()
    {
        $result = [
            'success' => false,
            'message' => '',
            'id' => null,
            'username' => '',
            'email' => ''
        ];

        // Le formulaire a été envoyé 
        // On vérifie que tous les champs requis sont remplis 
        if (
            isset($_POST["username"], $_POST["mail"], $_POST["password"])
            && !empty($_POST["username"]) && !empty($_POST["mail"]) && !empty($_POST["password"])
        ) {
            // Le formulaire est complet
            // On récupère les données en les protégeant avec strip_tags contre les attaques XSS 
            $username = strip_tags($_POST["username"]);
            $email = $_POST["mail"];

            // On va hasher le mot de passe
            $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);

            // Ajoutez ici tous les contrôles souhaités 

            // On va enregistrer en BDD
            $req = $this->getDb()->prepare("INSERT INTO `users` (`password`, `username`, `email`) VALUES (:password, :username, :email)");
            $req->bindValue(":password", $password, PDO::PARAM_STR);
            $req->bindValue(":username", $username, PDO::PARAM_STR);
            $req->bindValue(":email", $email, PDO::PARAM_STR);

            if ($req->execute()) {
                $result['success'] = true;
                $result['message'] = 'Utilisateur enregistré avec succès.';
                $result['id'] = $this->getDb()->lastInsertId();
                $result['username'] = $username;
                $result['email'] = $email;
            } else {
                $result['message'] = 'Impossible d\'ajouter l\'utilisateur à la base de données.';
            }
        } else {
            $result['message'] = 'Veuillez remplir tous les champs requis.';
        }

        return $result;
    }


    public function getConnectUser()
    {
        $result = [
            'success' => false,
            'message' => '',
            'user' => null
        ];

        // On vérifie si le formulaire a été envoyé
        if (!empty($_POST)) {
            // Le formulaire a été envoyé
            // On vérifie que tous les champs requis sont remplis
            if (
                isset($_POST["email"], $_POST["password"])
                && !empty($_POST["email"]) && !empty($_POST["password"])
            ) {
                // On vérifie que l'email est valide
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $result['message'] = "Ce n'est pas une adresse email valide.";
                } else {
                    // On recherche dans la table user
                    $req = $this->getDb()->prepare("SELECT * FROM `users` WHERE `email`= :email");
                    $req->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                    $req->execute();
                    $user = $req->fetch(PDO::FETCH_ASSOC);

                    if (!$user) {
                        $result['message'] = "L'email et/ou le mot de passe est incorrect.";
                    } else {
                        // L'utilisateur existe, on vérifie le mot de passe
                        if (password_verify($_POST["password"], $user["password"])) {
                            // Le mot de passe est correct
                            // On stocke les informations de l'utilisateur dans la session
                            $_SESSION["user"] = [
                                "id" => $user["id"],
                                "username" => $user["username"],
                                "email" => $user["email"]
                            ];
                            $result['success'] = true;
                            $result['message'] = 'Connexion réussie.';
                            $result['user'] = $_SESSION["user"];
                        } else {
                            $result['message'] = "L'email et/ou le mot de passe est incorrect.";
                        }
                    }
                }
            } else {
                $result['message'] = 'Veuillez remplir tous les champs requis.';
            }
        }

        return $result;
    }



    // public function getEditUser(){

    // }
}
