<?php
abstract class Controller
{
    private static $loader;
    private static $twig;

    private static function setLoader()
    {
        self::$loader = new \Twig\Loader\FilesystemLoader('./view');
    }

    private static function setTwig()
    {
        self::$twig = new \Twig\Environment(self::$loader, ['cache' => false,]);
    }

    private static function initialize()
    {
        self::setLoader();
        self::setTwig();
    }

    protected static function getLoader()
    {
        if (self::$loader === null) {
            self::initialize();
        }
        return self::$loader;
    }

    protected static function getTwig()
    {
        if (self::$twig === null) {
            self::initialize();
        }
        return self::$twig;
    }
}
