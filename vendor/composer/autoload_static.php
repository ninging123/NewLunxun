<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5a478863b4b8f6c846edea12731fa2db
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5a478863b4b8f6c846edea12731fa2db::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5a478863b4b8f6c846edea12731fa2db::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
