<?php
class Categories
{
    private $id;
    private $title;

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
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    //getter 

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
