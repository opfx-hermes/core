<?php
//@formatter:off
$MOCK_SERVER = array (
		'INSTALLATION_UID' => '1115172240',
		'ZEND_TMPDIR' => '/usr/local/zend/tmp',
		'USER' => 'nobody',
		'HOME' => '/',
		'HTTP_COOKIE' => 'ZS6SESSID=f8cb9f5026ccf026492c4b79911a1b9f; ZSDEVBAR=%7B%7D',
		'HTTP_ACCEPT_LANGUAGE' => 'en-US,en;q=0.9',
		'HTTP_ACCEPT_ENCODING' => 'gzip, deflate',
		'HTTP_REFERER' => 'http://hermes.bt.opfx.org/sb/ServiceBrowser.php',
		'HTTP_CONTENT_TYPE' => 'application/x-www-form-urlencoded',
		'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0...cut...',
		'HTTP_ZRAY_ID' => '3@8345@1511300892@0',
		'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
		'HTTP_ORIGIN' => 'http://hermes.bt.opfx.org',
		'HTTP_ACCEPT' => 'application/json, text/javascript, */*; q=0.01',
		'HTTP_CONTENT_LENGTH' => '80',
		'HTTP_HOST' => 'hermes.bt.opfx.org',
		'REDIRECT_STATUS' => '200',
		'SERVER_NAME' => 'hermes.bt.opfx.org',
		'SERVER_PORT' => '80',
		'SERVER_ADDR' => '172.31.18.48',
		'REMOTE_PORT' => '28928',
		'REMOTE_ADDR' => '204.50.157.66',
		'SERVER_SOFTWARE' => 'nginx/1.12.2',
		'GATEWAY_INTERFACE' => 'CGI/1.1',
		'REQUEST_SCHEME' => 'http',
		'SERVER_PROTOCOL' => 'HTTP/1.1',
		'DOCUMENT_ROOT' => '/usr/local/zend/var/apps/http/hermes.bt.opfx.org/80/_docroot_',
		'DOCUMENT_URI' => '/index.php',
		'REQUEST_URI' => '/index.php?contentType=application/json',
		'SCRIPT_NAME' => '/index.php',
		'SCRIPT_FILENAME' => '/usr/local/zend/var/apps/http/hermes.bt.opfx.org/80/_docroot_/index.php',
		'CONTENT_LENGTH' => '80',
		'CONTENT_TYPE' => 'application/x-www-form-urlencoded',
		'REQUEST_METHOD' => 'POST',
		'QUERY_STRING' => 'contentType=application/json',
		'FCGI_ROLE' => 'RESPONDER',
		'PHP_SELF' => '/index.php',
		'REQUEST_TIME_FLOAT' => 1511379201.74637508392333984375,
		'REQUEST_TIME' => 1511379201,
);

$MOCK_GET = array (
		'contentType' => 'application/json',
);



function createRequest($serviceName, $methodName, $parameters=[]) {
	$request = new stdClass();
	$request->session = new stdClass();
	$request->session->id = 'debug';
	$request->target = new stdClass();
	$request->target->serviceName = $serviceName;
	$request->target->methodName = $methodName;
	$request->target->parameters = $parameters;

	$request = json_encode($request);
	return $request;
}


$MOCK_COOKIE = array (
		'ZS6SESSID' => 'f8cb9f5026ccf026492c4b79911a1b9f',
		'ZSDEVBAR' => '{}',
);

$request = createRequest('AccountsService', 'login', ['btw01', 'e3e3e3']);

$MOCK_RAWPOST =$request;

//@formatter:on
