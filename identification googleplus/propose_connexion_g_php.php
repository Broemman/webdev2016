<?php
session_start();

/*	https://developers.google.com/identity/protocols/OAuth2WebServer#preparing-to-start-the-oauth-20-flow
	(https://developers.google.com/identity/protocols/OpenIDConnect#setredirecturi ?)
*/	

// tests sur https://bastv.olympe.in/pweb2016/propose_connexion_g_php.php

// Crée un lien vers l'authentification Google.
// dans l'url, des paramètres (à destination de Google) donnent notre ID client et l'adresse de retour.
// le visiteur s'identifie sur google puis est renvoyé sur notre site. La page de retour reçoit (par la méthode GET)
// un 'authorization code'




$redirect="https://bastv.olympe.in/pweb2016/recoit_connexion_g_php.php";

// ces infos sont maintenant dans le fichier json ou dans la libraire de gogole
/*
$url_auth = "https://accounts.google.com/o/oauth2/v2/auth";
$id_client="22946272988-a3e2srpeacg8apvl36g5ii09sh4uea89.apps.googleusercontent.com";
*/




// utilise la librairie PHP google
// dans une ancienne version v1, parce que les nouvelles demandent composer
set_include_path(get_include_path() . PATH_SEPARATOR . 'google-api-php-client-1.1.7/src');
require_once("google-api-php-client-1.1.7/src/Google/autoload.php");


$client = new Google_Client();
$client->setAuthConfigFile('cred/client_secret_22946272988-a3e2srpeacg8apvl36g5ii09sh4uea89.apps.googleusercontent.com.json');
//$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
//$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
$client->setRedirectUri('https://bastv.olympe.in/pweb2016/recoit_connexion_g_php.php');

$client->addScope("profile");


// pour une liste des scopes, voir https://developers.google.com/+/web/api/rest/oauth#login-scopes
// il y a des constantes définies dans Service/Oauth2.php, mais scopes v1 qui peuvent être 'deprecated'


echo "<pre>";
print_r($client);
echo "</pre>";



// ancienne méthode http
/*$url = $url_auth."?"
	."response_type=code"
	."&client_id=".urlencode($id_client)
	."&redirect_uri=".urlencode($redirect)
	."&scope=profile";
*/

$url = $client->createAuthUrl();

//$_SESSION['client']=$client;  // à faire ?

echo "<a href='$url'>Connexion avec l'api php</a><br>";

echo "<br>";
echo "url du lien :<br>".$url;


?>