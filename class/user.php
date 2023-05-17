<?php
class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $created_at;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    private function hydrate($datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Setter methods
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setCreated_at(?string $created_at)
    {
        $this->created_at = $created_at;
    }

    // Getter methods
    public function getUsername()
    {
        return $this->username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }
}
