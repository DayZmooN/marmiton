<?php
class Recipes
{
    private $id_recipes;
    private $title;
    private $slug;
    private $duration;
    private $user_id;
    private $thumbnail;
    private $content;


    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    private function hydrate($datas)
    {
        foreach ($datas as $key => $value) {
            $methode = 'set' . ucfirst($key);
            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }

    //setter
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    public function setThumbnail(string $thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }
    public function setId_recipes(int $id_recipes)
    {
        $this->id_recipes = $id_recipes;
    }
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }
    public function setDuration(int $duration)
    {
        $this->duration = $duration;
    }
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function setUser_id(int $user_id)
    {
        $this->user_id = $user_id;
    }



    //getter
    public function getTitle()
    {
        return $this->title;
    }
    public function getId_recipes()
    {
        return $this->id_recipes;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    public function getDuration()
    {
        return $this->duration;
    }
    public function getUser_id()
    {
        return $this->user_id;
    }
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
    public function getContent()
    {
        return $this->content;
    }
}
