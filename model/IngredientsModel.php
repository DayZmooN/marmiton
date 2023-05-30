<?php
class IngredientsModel extends Model
{
    public function getAllIngredients()
    {
        $ingredients = [];
        $req = $this->getDb()->query("SELECT `id`, `name` FROM `ingredients` ORDER BY `id`;");
        while ($ingredient = $req->fetch(PDO::FETCH_ASSOC)) {
            $ingredients[] = new Ingredients($ingredient['id'], $ingredient['name']);
        }
        return $ingredients;
    }

    public function getOneIngredient($id)
    {
        $req = $this->getDb()->prepare('SELECT `id`, `name` FROM `ingredients` WHERE `id` = :id');
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $ingredient = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $ingredient ? new Ingredients($ingredient['id'], $ingredient['name']) : null;
    }

    public function addIngredient($name)
    {
        $req = $this->getDb()->prepare("INSERT INTO `ingredients` (`name`) VALUES (:name)");
        $req->bindParam(':name', $name, PDO::PARAM_STR);
        $req->execute();
    }

    public function deleteIngredient($id)
    {
        $req = $this->getDb()->prepare("DELETE FROM `ingredients` WHERE `id` = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function updateIngredient($id, $name)
    {
        $req = $this->getDb()->prepare("UPDATE `ingredients` SET `name` = :name WHERE `id` = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->bindParam(':name', $name, PDO::PARAM_STR);
        $req->execute();
    }

    public function getIngredientByName($name)
    {
        $req = $this->getDb()->prepare("SELECT `id`, `name` FROM `ingredients` WHERE `name` = :name");
        $req->bindParam(':name', $name, PDO::PARAM_STR);
        $req->execute();
        $ingredient = $req->fetch(PDO::FETCH_ASSOC);

        return $ingredient ? new Ingredients($ingredient['id'], $ingredient['name']) : null;
    }

    public function createIngredient($name)
    {
        try {
            $req = $this->getDb()->prepare("INSERT INTO `ingredients` (`name`) VALUES (:name)");
            $req->bindParam(':name', $name, PDO::PARAM_STR);
            $req->execute();

            return $this->getDb()->lastInsertId();
        } catch (PDOException $e) {
            // Gérer les erreurs de création d'ingrédient
            // Par exemple, afficher un message d'erreur ou journaliser l'erreur
            return false;
        }
    }

    public function getIngredients($id)
    {
        $req = $this->getDb()->prepare("SELECT `id`, `name` FROM `ingredients` WHERE `id` = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $ingredient = $req->fetch(PDO::FETCH_ASSOC);

        return $ingredient ? new Ingredients($ingredient['id'], $ingredient['name']) : null;
    }

    public function addIngredientToRecipe($recipeId, $ingredientId)
    {
        $req = $this->getDb()->prepare("INSERT INTO `recipe_ingredients` (`recipe_id`, `ingredient_id`) VALUES (:recipe_id, :ingredient_id)");
        $req->bindParam(':recipe_id', $recipeId, PDO::PARAM_INT);
        $req->bindParam(':ingredient_id', $ingredientId, PDO::PARAM_INT);
        $req->execute();
    }
}
