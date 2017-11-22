<?php

function ___PHAR___STARTUP() {
	$___PHAR___DEBUG = false;
	if ( isset( $_SERVER['QUERY_STRING'] ) && stripos( $_SERVER['QUERY_STRING'], 'start_debug' ) !== false ) {
		$___PHAR___DEBUG = true;
	}
	if ( defined( 'DEBUG' ) ) {
		$___PHAR___DEBUG = true;
	}
	static $classes = null;
	if ( $classes === null ) {

		$___PHAR___PATH = "phar://___PHAR___";
		$___PHAR___TIME = "___CREATED___";
		// check if the associated source code for this phar is available
		if ( $___PHAR___DEBUG ) {

			$___PHAR___SRC = dirname( __FILE__, 2 ) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "main" . DIRECTORY_SEPARATOR . "php";
			if ( ! file_exists( $___PHAR___SRC ) ) {
				$___PHAR___SRC = dirname( __FILE__, 2 ) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "___PHAR___";

				$___PHAR___LockFileInfo = new SplFileInfo( "$___PHAR___SRC/___PHAR___.lock" );
				if ( ! file_exists( $___PHAR___SRC ) ) {
					mkdir( $___PHAR___SRC, 0777, true );
				}
				$___PHAR___PharFileInfo = new SplFileInfo( __FILE__ );

				if ( ! file_exists( $___PHAR___LockFileInfo ) || ( $___PHAR___LockFileInfo->getMTime() < $___PHAR___PharFileInfo->getMTime() ) ) {
					$phar = new Phar( __FILE__ );
					$phar->extractTo( $___PHAR___SRC, null, true );
					touch( "$___PHAR___SRC/___PHAR___.lock" );
				}
			}
			$___PHAR___PATH = $___PHAR___SRC;
			set_include_path( get_include_path() . PATH_SEPARATOR . $___PHAR___PATH );
		}

		$classes = array ( ___CLASSLIST___ );

		$___PHAR___ClassLoader = function ( $cn ) use ($classes, $___PHAR___PATH ) {

			$cn = strtolower( $cn );
			if ( ! isset( $classes[$cn] ) ) {
				return;
			}
			require_once "{$___PHAR___PATH}{$classes[$cn]}";
		};

		spl_autoload_register( $___PHAR___ClassLoader );
		Phar::mapPhar( '___PHAR___' );
	}

	if ( $___PHAR___DEBUG ) {
		foreach ( $classes as $cn => $path ) {
			$___PHAR___ClassLoader( $cn );
		}
	}
}

___PHAR___STARTUP();

__HALT_COMPILER();