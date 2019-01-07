<?php
/**
 * Created by PhpStorm.
 * User: broeker
 * Date: 1/7/19
 * Time: 4:52 PM
 */
$aliases['snapple.dev'] = array(
    'uri' => 'dev-snapple.pantheonsite.io',
    'db-url' => 'mysql://pantheon:f87d9db78efd4f7ba68bc1665a81c9a9@dbserver.dev.16db21d2-e3cd-4dd4-bd6d-33f8ab398bb4.drush.in:20438/pantheon',
    'db-allows-remote' => TRUE,
    'remote-host' => 'appserver.dev.16db21d2-e3cd-4dd4-bd6d-33f8ab398bb4.drush.in',
    'remote-user' => 'dev.16db21d2-e3cd-4dd4-bd6d-33f8ab398bb4',
    'ssh-options' => '-p 2222 -o "AddressFamily inet"',
    'path-aliases' => array(
        '%files' => 'files',
        '%drush-script' => 'drush',
    ),
);
