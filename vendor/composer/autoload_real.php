<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit2897e6a7ecfa1729561bbff8085c8632
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

        spl_autoload_register(array('ComposerAutoloaderInit2897e6a7ecfa1729561bbff8085c8632', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit2897e6a7ecfa1729561bbff8085c8632', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit2897e6a7ecfa1729561bbff8085c8632::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
