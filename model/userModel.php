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



    public function getUserRecipes(int $userId)
    {
        $recipes = [];

        $req = $this->getDb()->prepare('SELECT `recipes`.`id_recipes`, `recipes`.`userid`, `recipes`.`title`, `recipes`.`duration`, `recipes`.`thumbnail`, `recipes`.`content`, `recipes`.`created_at`, `users`.`id`, `users`.`username`, `users`.`email`,  `users`.`password`
            FROM `recipes`
            INNER JOIN `users`
            ON `recipes`.`userid` = `users`.`id`
            WHERE `recipes`.`userid` = :id');
        $req->bindParam(':id', $userId, PDO::PARAM_INT);
        $req->execute();

        while ($recipeData = $req->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = new Recipes($recipeData);
        }

        $req->closeCursor();
        return $recipes;
    }






    // public function getEditUser()
    // {
    // }
}
