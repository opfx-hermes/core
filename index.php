<?php
require_once 'mockrequest.php';

$_SERVER = array_merge( $_SERVER, $MOCK_SERVER );
$_GET = array_merge( $_GET, $MOCK_GET );
$_POST = array_merge( $_POST, $MOCK_POST );
$_REQUEST = array_merge( $_GET, $_POST );
$_COOKIE = array_merge( $_COOKIE, $MOCK_COOKIE );
$_COOKIE['debug_host'] = '127.0.0.1';

require_once '../opfx/dist/opfx.phar';
require_once 'dist/core.phar';

use hermes\Application;

Application::main();