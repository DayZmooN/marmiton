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

    // public function getOneUserByMail(string $email)
    // {
    //     $req = $this->getDb()->prepare("SELECT `id`, `username`, `email`, `password` FROM `users` WHERE `email` = :email");
    //     $req->bindParam(':email', $email); // Assurez-vous que le paramètre :email est correctement défini dans la requête SQL
    //     $req->execute();
    //     $user = $req->fetch(PDO::FETCH_ASSOC);


    //     return $user;
    //     // Ajouter cette ligne pour retourner le résultat
    // }
    public function getOneUserByMail(string $email)
    {
        $req = $this->getDb()->prepare("SELECT `id`, `username`, `email`, `password` FROM `users` WHERE `email` = :email");
        $req->bindParam(':email', $email);
        $req->execute();

        $user = $req->fetch(PDO::FETCH_ASSOC);

        return $user ? new User($user) : false;
    }
    public function checkEmailExists($email)
    {
        $req = $this->getDb()->prepare("SELECT COUNT(*) FROM `users` WHERE `email` = :email");
        $req->bindParam(':email', $email);
        $req->execute();

        return $req->fetchColumn() > 0;
    }



    // public function checkLogin($email, $password)
    // {
    //     $req = $this->getDb()->prepare("SELECT `id`, `username`, `email`, `password` FROM `users` WHERE `email` = :email");
    //     $req->bindParam(':email', $email); // Assurez-vous que le paramètre :email est correctement défini dans la requête SQL
    //     $req->execute();
    //     $user = $req->fetch(PDO::FETCH_ASSOC);


    //     return $user;
    //     // Ajouter cette ligne pour retourner le résultat
    // }





    // public function getEditUser()
    // {
    // }
}
