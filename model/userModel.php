<?php

class UserModel extends Model
{
    public function saveUser(User $user)
    {
        $result = [
            'success' => false,
            'message' => '',
            'id' => null,
            'username' => '',
            'email' => '',
        ];
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        // On va enregistrer en BDD
        $req = $this->getDb()->prepare("INSERT INTO `users` (`password`, `username`, `email`) VALUES (:password, :username, :email)");
        $req->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
        $req->bindValue(":username", $user->getUsername(), PDO::PARAM_STR);
        $req->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $req->execute();

        return $result;
    }




    public function checkLogin($email, $password)
    {
        // On vérifie que l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // On recherche dans la table user
        $stmt = $this->getDb()->prepare("SELECT * FROM `users` WHERE `email`= ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe et si le mot de passe est valide
        if ($result && password_verify($password, $result['password'])) {
            return new User($result);
        } else {
            return false;
        }
    }




    // public function getEditUser()
    // {
    // }
}
