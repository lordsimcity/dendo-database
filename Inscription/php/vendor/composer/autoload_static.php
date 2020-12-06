<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaa8d808705dc7b4e7a3c1c57234e4621
{
    public static $prefixLengthsPsr4 = array (
        'R' =>
        array (
            'Registration\\Informations\\' => 26,
            'Registration\\DatabaseHandling\\' => 30,
            'Registration\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Registration\\Informations\\' =>
        array (
            0 => __DIR__ . '/../..' . '/class/Informations',
        ),
        'Registration\\DatabaseHandling\\' =>
        array (
            0 => __DIR__ . '/../..' . '/class/DatabaseHandling',
        ),
        'Registration\\' =>
        array (
            0 => __DIR__ . '/../..' . '/class',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaa8d808705dc7b4e7a3c1c57234e4621::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaa8d808705dc7b4e7a3c1c57234e4621::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
