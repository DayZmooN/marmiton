<?php
abstract class Model
{
    private static $db;
    private static function setDb()
    {
        try {
            self::$db = new PDO('mysql:host=localhost;dbname=marmiton;charset=utf8', 'root');
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage() . '<br>';
        }
    }

    protected function getDb()
    {
        if (self::$db == null) {
            self::setDb();
        }
        return self::$db;
    }
}
