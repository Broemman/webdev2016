<?php
session_start();

set_include_path(get_include_path() . PATH_SEPARATOR . 'google-api-php-client-1.1.7/src');
require_once("google-api-php-client-1.1.7/src/Google/autoload.php");

// en cas d'erreur, $_get['error'] contient le message d'erreur, sinon $_get['code'] contient le authorization code

echo "Réponse de gogole :<br>";
if(isset($_GET))
	var_dump($_GET); else echo "raté";


$client = new Google_Client();
$client->setAuthConfigFile('cred/client_secret_22946272988-a3e2srpeacg8apvl36g5ii09sh4uea89.apps.googleusercontent.com.json');
$client->setRedirectUri('https://bastv.olympe.in/pweb2016/recoit_connexion_g_php.php');
$client->addScope("profile");

if(isset($_GET['code'])){
	$client->authenticate($_GET['code']);
	$acces_token = $client->getAccessToken();
	$oauth2 = new Google_Service_Oauth2($client);
	$infos = $oauth2->userinfo->get();
	$user_mail = $infos->email;
	echo "<pre>";
	echo "userinfo->get() : \n";
	print_r($infos);
	print_r($user_mail);
	echo "</pre>";
	}
	
// à ce stade on a le mail du gars dans $user_mail, il faut vérifier qu'il est dans la bdd du site



// utile ?
$client->revokeToken();






// à suivre : https://developers.google.com/identity/protocols/OAuth2WebServer
// et https://developers.google.com/api-client-library/php/auth/web-app

// "If your response endpoint renders an HTML page, any resources on that page will be able to see the authorization code
// in the URL. Scripts can read the URL directly, and all resources may be sent the URL in the Referer HTTP header.
//  Carefully consider if you want to send authorization credentials to all resources on that page. To avoid this issue,
// we recommend that the server first handle the request, then redirect to another URL that doesn't include the response
// parameters.

?>