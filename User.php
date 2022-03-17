<?php
session_start();


class User
{

    private $id;
    private $name;
    private $surname;
    private $login;
    private $password;
    private $role;

    const CLIENT = 'Client'; //Вы можете на сайте просматривать информацию доступную пользователям
    const ADMIN = 'Admin'; //Админ - Вы можете на сайте делать все
    const MANEGER = 'Maneger'; //Вы можете на сайте изменять, удалять и создавать клиентов

    static $users = [
        1 => ['name' => 'Василий', 'surname' => 'Лоханкин', 'login' => 'Vasisualiy', 'password' => '12345', 'lang' => 'ru', 'role' => 'admin'],
        2 => ['name' => 'Афанасий', 'surname' => 'Цукерберг', 'login' => 'Afanasiy', 'password' => '12345', 'lang' => 'en', 'role' => 'client'],
        3 => ['name' => 'Петр', 'surname' => 'Инкогнито', 'login' => 'Petro', 'password' => '12345', 'lang' => 'ua', 'role' => 'maneger'],
        4 => ['name' => 'Педро', 'surname' => 'Миланов', 'login' => 'Pedrolus', 'password' => '12345', 'lang' => 'it', 'role' => 'client'],
        5 => ['name' => 'Александр', 'surname' => 'Александров', 'login' => 'Sasha', 'password' => '12345', 'role' => 'client', 'lang' => null],
    ];

    public function __construct($id)
    {
        $user = self::$users[$id];
        $this->name = $user['name'];
        $this->surname = $user['surname'];
        $this->id = $user['id'];
        $this->login = $user['login'];
        $this->password = $user['password'];
        $this->role = $user['role'];
        $this->lang = $user['lang'];

    }

    public function __get($value)
    {
        return ($value !== 'password') ? $this->{$value} : null;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getlang()
    {
        return $this->lang;
    }


    public static function auth($password, $login)
    {
        $user = null;
        foreach (self::$users as $key => $value) {
            if ($login == $value['login'] && $password == $value['password']) {
                $user = new User($key);
                $_SESSION['id'] = $key;
            }
        }

        return $user;
    }

    public static function getCurrentUser()
    {
        $user = null;
        if ($_SESSION['id']) {
            $user = self::$users[$_SESSION['id']];
        }

        return $user;
    }

    public static function logOut()
    {
        $_SESSION = [];
        header("Location:form.php");
    }
}

