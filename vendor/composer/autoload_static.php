<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc819bec24f2c62a666e8f7ca521546d1
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kund24\\' => 7,
        ),
        'H' => 
        array (
            'Html2Text\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kund24\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Html2Text\\' => 
        array (
            0 => __DIR__ . '/..' . '/html2text/html2text/src',
            1 => __DIR__ . '/..' . '/html2text/html2text/test',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc819bec24f2c62a666e8f7ca521546d1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc819bec24f2c62a666e8f7ca521546d1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
