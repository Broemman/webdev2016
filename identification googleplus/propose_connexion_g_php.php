<?php

// script qui cr�e un lien de connexion via Google +
// tests sur https://bastv.olympe.in/pweb2016/propose_connexion_g_php.php


session_start();

// si un utilisateur est d�j� connect�, ne pas faire de lien
if(isset($_SESSION['id_user']) && $_SESSION['id_user']){
	
}

else
{
	// inclut la librairie PHP google
	// (dans une ancienne version v1, parce que les nouvelles demandent composer)

	set_include_path(get_include_path() . PATH_SEPARATOR . 'google-api-php-client-1.1.7/src');
	require_once("google-api-php-client-1.1.7/src/Google/autoload.php");
	
	$redirect="https://bastv.olympe.in/pweb2016/recoit_connexion_g_php.php";



$client = new Google_Client();
$client->setAuthConfigFile('cred/client_secret_22946272988-a3e2srpeacg8apvl36g5ii09sh4uea89.apps.googleusercontent.com.json');	// fichier (priv� !) contenant les 'credentials' de notre app, il faudra mettre celles de l'ifosup
$client->setRedirectUri('https://bastv.olympe.in/pweb2016/recoit_connexion_g_php.php');		// � changer par la suite pour mettre une page de notre site
$client->addScope("profile");
$client->addScope("email");

// pour une liste des scopes, voir https://developers.google.com/+/web/api/rest/oauth#login-scopes
// il y a des constantes d�finies dans Service/Oauth2.php, mais scopes v1 qui peuvent �tre 'deprecated'

$url = $client->createAuthUrl();

echo "<a href='$url'>Se connecter via Google +</a><br>";

echo "<br>";
echo "url du lien :<br>".$url;

}	// fin if (pas d'utilisateur connect�)

/*
	principe : dans l'url du lien de connexion, des param�tres (� destination de Google) donnent l'ID client de notre "app" et l'adresse de retour.
	le visiteur s'identifie sur google puis est renvoy� sur notre site. La page de retour re�oit (par la m�thode GET)
	un 'authorization code', qu'elle �change contre un 'access token', qui lui permet d'obtenir des infos sur celui
	qui s'est enregistr�.
*/
	
/*
	https://developers.google.com/identity/protocols/OAuth2WebServer#preparing-to-start-the-oauth-20-flow
	(https://developers.google.com/identity/protocols/OpenIDConnect#setredirecturi ?)
*/	
