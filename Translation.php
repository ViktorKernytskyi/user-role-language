<?php
session_start();
require_once('User.php');
require_once('init.php');

class Translation
{
    protected $user;

    protected $no_lang = ['hello' => 'Язык не найден', 'opportunities' => 'выберите язык'];

    static $translations = [
        'ru' => ['hello'=> 'русский корабль иди на х*й', 'opportunities'=> 'повторять не буду'],
        'en' => ['hello'=> 'hi', 'opportunities'=> 'You can view information available to users on the site'],
        'it' => ['hello'=> 'Ehi', 'opportunities'=> 'È possibile visualizzare le informazioni disponibili per gli utenti sul sito'],
        'ua' => ['hello'=> 'привіт', 'opportunities'=> 'Ви можете на сайті змінювати, видаляти та створювати клієнтів']
    ];

    protected $lang = [];

    public function __construct(User $user, $locale = null)
    {

        $this->user = $user;

        $this->setLocale($locale);
    }

    public function setLocale($locale = null)
    {
        $this->lang = $locale ?? $this->user->lang;
        $_SESSION['lang'] = $this->lang;
        return  $this->lang;
    }

    public function getTranslation()
    {
        if ($this->hasLang())
            return self::$translations[$this->lang];

        return $this->no_lang;
    }

    public function getLocale()
    {
        return $this->lang;
    }

    public function hasLang()
    {
        return (bool)$this->user->lang || $this->lang;
    }




}