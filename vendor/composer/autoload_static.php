<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb0bb932b2804ecd2d05bcf3bf2d8d6ba
{
    public static $files = array (
        'e471bf351add62873bc0289ccd6a937f' => __DIR__ . '/..' . '/league/plates/src/Template/match.php',
        '152c98af9456eeb8f53697d6a7dfd689' => __DIR__ . '/..' . '/league/plates/src/Extension/Data/data.php',
        'e20239a76b73b9912f51f0005956d1db' => __DIR__ . '/..' . '/league/plates/src/Extension/Path/path.php',
        'd513f8e004e152493580ca1917e308ba' => __DIR__ . '/..' . '/league/plates/src/Extension/RenderContext/func.php',
        '27980683f1626a3fd1405d27b171c0fe' => __DIR__ . '/..' . '/league/plates/src/Extension/RenderContext/render-context.php',
        'bdc465a053da7f7ddb072631f6d41d45' => __DIR__ . '/..' . '/league/plates/src/Extension/LayoutSections/layout-sections.php',
        'afa76803f24616d7599be3b7b0846adc' => __DIR__ . '/..' . '/league/plates/src/Extension/Folders/folders.php',
        '16c5be35e32c6cf916d875518b909210' => __DIR__ . '/..' . '/league/plates/src/Util/util.php',
        'aa734ccb21cc7c8b3c0961614bc7928e' => __DIR__ . '/../..' . '/source/Boot/config.php',
        'c0871310f620f4bda772baae2ce8149a' => __DIR__ . '/../..' . '/source/Boot/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Source\\' => 7,
        ),
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
        'C' => 
        array (
            'CoffeeCode\\Router\\' => 18,
            'CoffeeCode\\DataLayer\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
        'CoffeeCode\\DataLayer\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/datalayer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb0bb932b2804ecd2d05bcf3bf2d8d6ba::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb0bb932b2804ecd2d05bcf3bf2d8d6ba::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb0bb932b2804ecd2d05bcf3bf2d8d6ba::$classMap;

        }, null, ClassLoader::class);
    }
}
