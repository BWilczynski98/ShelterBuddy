<?php
declare(strict_types=1);

namespace Core;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private static ?Environment $twig = null;

    private static function getTwig(): Environment
    {
        if (self::$twig === null) {
            $loader = new FilesystemLoader(APP_ROOT . "/src/App/Views");
            self::$twig = new Environment($loader, [
                'cache' =>  APP_ROOT . '/var/cache/',
                'debug' =>  DEV,
            ]);

            self::$twig->addGlobal('doc_root', DOC_ROOT);

            if (DEV === true) {
                self::$twig->addExtension(new \Twig\Extension\DebugExtension());
            }
        }

        return self::$twig;
    }

    public static function render($template, $data = [])
    {
        echo self::getTwig()->render($template, $data);
    }
}