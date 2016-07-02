<?php
//Allow PHP's built-in server to serve our static content in local dev:
if (php_sapi_name() === 'cli-server' && is_file(__DIR__.'/static'.preg_replace('#(\?.*)$#','', $_SERVER['REQUEST_URI']))
   ) {
  return false;
}

require 'vendor/autoload.php';
use Symfony\Component\HttpFoundation\Response;
$app = new \Silex\Application();
$app['debug'] = true;
$app->get('/', function () use ($app) {
  return $app->sendFile('./static/index.html');
});

$app->get('/hello/{name}', function ($name) use ($app) {
  return $app->json( array('Hello'=> $app->escape($name)));
  //return new Response( "Hello, {$app->escape($name)}!");
});

$app->get('/cord/{lat}/{lon}', function ($lat,$lon) use ($app) {
	
	$curl = curl_init();
	
	$url = "http://api.openweathermap.org/data/2.5/find?lat=$lat&lon=$lon&cnt=1&appid=2a4232ec0f2f82a8f8a10600a21b9481&units=metric";
			
	curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache"
			),
	));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		return $app->json($err);
	} else {
		return new Response($response, 200,['Content-Type' => 'application/json']);
	}
});
	
	
$app->get('/find/{city}', function ($city) use ($app) {
	
	$url = 'http://api.openweathermap.org/data/2.5/find?q='.urlencode($city).'&cnt=1&appid=2a4232ec0f2f82a8f8a10600a21b9481&units=metric';
	
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache"					
			),
	));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		return $app->json($err);
	} else {		
		return new Response($response, 200,['Content-Type' => 'application/json']);
	}
	
});

$app->run();
?>
