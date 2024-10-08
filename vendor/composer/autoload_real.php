<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbc9b54463c8edc5c63fa35d04b78a6dd
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitbc9b54463c8edc5c63fa35d04b78a6dd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbc9b54463c8edc5c63fa35d04b78a6dd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbc9b54463c8edc5c63fa35d04b78a6dd::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
