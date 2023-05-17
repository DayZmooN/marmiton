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
        session_start();
        self::$twig = new \Twig\Environment(self::$loader, ['cache' => false, 'debug' => true]);
        //sert a debug ton twig
        self::$twig->addExtension(new \Twig\Extension\DebugExtension());
        self::$twig->addGlobal('session', $_SESSION);

        // $twig->addGlobal('get', $_GET);
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
        if (self::$twig === null || isset($_SESSION)) {
            self::initialize();
        }
        return self::$twig;
    }
}
