<?php
$projRootDir = dirname( __FILE__, 4 );

$includePath = [ ];
$includePath[] = get_include_path();
$includePath[] = "$projRootDir/dist";
$includePath[] = "$projRootDir/src/test/php";
$includePath = implode( PATH_SEPARATOR, $includePath );

set_include_path( $includePath );

define( 'DEBUG', true );
define( 'ODBC_INI_FILENAME', "$projRootDir/src/test/resources/etc/odbc.ini" );

spl_autoload_register( function ( $cn ) {

	try {
		include "$cn.php";
	} catch ( Exception $e ) {
		$t = $e;
		return;
	}
} );

define( 'DEPENDENCIES', "{$projRootDir}/../opfx/dist/opfx.phar;core.phar" );

$dependencies = explode( PATH_SEPARATOR, DEPENDENCIES );
foreach ( $dependencies as $dependency ) {
	$dependency = trim( $dependency );
	require_once $dependency;
}
?>