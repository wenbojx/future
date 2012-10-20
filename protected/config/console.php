<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR,
    'name'=>'My Console Application',
	'charset'=>'utf-8',
    'import'=>array(
        'webroot.models.*',
        'webroot.models.scenes.*',
        'webroot.models.file.*',
        'webroot.models.member.*',
        'webroot.components.*',
        'webroot.helpers.*',
        'webroot.class.*',
        'webroot.class.saladoPlayer.*',
    ),
    // application components
    'components'=>array(
        /* 'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ), */
        // uncomment the following to use a MySQL database
        'db'=>array(
            'connectionString' => 'mysql:host=192.168.2.100;dbname=album',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'wenbojx',
            'charset' => 'utf8',
    		'tablePrefix' => 'al_',
        ),
        'image'=>array(
                    'class'=>'application.extensions.image.CImageComponent',
                    // GD or ImageMagick
                    'driver'=>'GD',
            ),


    ),


);