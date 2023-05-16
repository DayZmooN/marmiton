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

    public function checkLogin($email)
    {
        // $result = [
        //     'success' => false,
        //     'message' => '',
        //     'user' => null
        // ];

        // On vérifie que l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result['message'] = "Ce n'est pas une adresse email valide.";
        } else {
            // On recherche dans la table user
            $req = $this->getDb()->prepare("SELECT * FROM `users` WHERE `email`= :email");
            $req->bindValue(":email", $email, PDO::PARAM_STR);
            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);
        }
        return $result->rowCount() == 1 ? new User($result) : false;
    }






    // public function getEditUser()
    // {
    // }
}
