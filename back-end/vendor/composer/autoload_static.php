<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc3bc14f94508f5af5cdc5c0417970480
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Symfony\\Component\\Routing\\' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/routing',
            ),
            'Symfony\\Component\\HttpKernel\\' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/http-kernel',
            ),
            'Symfony\\Component\\HttpFoundation\\' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/http-foundation',
            ),
            'Symfony\\Component\\EventDispatcher\\' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/event-dispatcher',
            ),
            'Symfony\\Component\\Debug\\' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/debug',
            ),
            'Silex' => 
            array (
                0 => __DIR__ . '/..' . '/silex/silex/src',
            ),
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 
            array (
                0 => __DIR__ . '/..' . '/psr/log',
            ),
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/lib',
            ),
        ),
    );

    public static $classMap = array (
        'SessionHandlerInterface' => __DIR__ . '/..' . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs/SessionHandlerInterface.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitc3bc14f94508f5af5cdc5c0417970480::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitc3bc14f94508f5af5cdc5c0417970480::$classMap;

        }, null, ClassLoader::class);
    }
}