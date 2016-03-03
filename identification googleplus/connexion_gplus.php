<?php

// script qui cr�e un lien de connexion via Google +
// tests sur https://bastv.olympe.in/pweb2016/propose_connexion_g_php.php


session_start();

// si l'utilisateur est d�j� connect�, ne rien faire
if(isset($_SESSION['id_user']) && $_SESSION['id_user']){
	echo "vous �tes d�j� connect� au site.";	
}

else{
	// inclut la librairie PHP google
	// (dans une ancienne version v1, parce que les nouvelles demandent composer)
	
	set_include_path(get_include_path() . PATH_SEPARATOR . 'google-api-php-client-1.1.7/src');
	require_once("google-api-php-client-1.1.7/src/Google/autoload.php");
	
	$redirect="https://bastv.olympe.in/pweb2016/connexion_gplus.php";
	//fichier contenant les ids secrets (SECRETS) de l'app, il faudra mettre celles de l'ifosup (quand elles seront faites)
	$json_credentials = 'cred/client_secret_22946272988-a3e2srpeacg8apvl36g5ii09sh4uea89.apps.googleusercontent.com.json';

	$client = new Google_Client();
	$client->setAuthConfigFile($json_credentials);
	$client->setRedirectUri($redirect);
	$client->addScope("profile");
	$client->addScope("email");

	// apr�s connexion sur la page de google, on re�oit un 'authorization code', on s'en sert pour obtenir l'adresse mail
	if(isset($_GET['code'])){
		$client->authenticate($_GET['code']);
		$acces_token = $client->getAccessToken();
		$oauth2 = new Google_Service_Oauth2($client);
		$infos = $oauth2->userinfo->get();
		$user_mail = $infos->email;
		// � ce stade on a le mail de l'user, si il correspond � ce qu'on a dans notre bdd, on le connecte
		
		 // affichage des donn�es pour debug
		 echo "<pre>";
		 echo "user info : \n";
		 print_r($infos);
		 print_r($user_mail);
		 echo "</pre>";
	}
	// (v�rifier �ventuellement un $_GET['error']) (r�ponse de google)
	else{		// sinon, cr�er le lien de connexion (n�cessite que l'$user ait �t� cr�� et param�tr�)
	$url_auth = $client->createAuthUrl();
	echo "<a href='".$url_auth."'>Se connecter via Google +</a><br>";
	echo "<br>";
	}
	
}

	
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
/*
	// pour une liste des scopes, voir https://developers.google.com/+/web/api/rest/oauth#login-scopes
	// il y a des constantes d�finies dans Service/Oauth2.php, mais scopes v1 qui peuvent �tre 'deprecated'
*/