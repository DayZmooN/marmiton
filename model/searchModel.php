<?php

class SearchModel extends Model
{

    public function getSearchResult($searchTerm)
    {

        $searchTerm = '%' . strtolower($searchTerm) . '%';

        $req = $this->getDb()->prepare("SELECT `id_recipes`, `userid`, `title`, `duration`,`thumbnail`, `content`, `created_at`,`slug` 
        FROM `recipes`  
        WHERE `title` LIKE :search_term 
        OR `duration` LIKE :search_term 
        OR `content` LIKE :search_term  
        ORDER BY `id_recipes`");

        $req->bindValue(':search_term', $searchTerm, PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        $req->closeCursor();
        return $result;
    }
}
