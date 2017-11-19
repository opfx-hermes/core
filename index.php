<?php
use hermes\Application;

$val = null;
$t = json_decode( 'null' );

$e = $t;

$_SERVER['REQUEST_URI'] = '/api/v1/content/items';

require_once '../opfx/dist/opfx.phar';
require_once 'dist/core.phar';

Application::main();