<?php
class Recipes
{
    private $id_recipes;
    private $title;
    private $slug;
    private $duration;
    private $userid;
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

    public function setUserid(int $userid)
    {
        $this->userid = $userid;
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
    public function getUserid()
    {
        return $this->userid;
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

class RecipeCreationResult
{
    private $success;
    private $message;

    public function __construct(bool $success, string $message)
    {
        $this->success = $success;
        $this->message = $message;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
