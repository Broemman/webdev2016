<?php

/*	https://developers.google.com/identity/protocols/OAuth2WebServer#preparing-to-start-the-oauth-20-flow
	(https://developers.google.com/identity/protocols/OpenIDConnect#setredirecturi ?)
*/	



// Crée un lien vers l'authentification Google.
// dans l'url, des paramètres (à destination de Google) donnent notre ID client et l'adresse de retour.
// le visiteur s'identifie sur google puis est renvoyé sur notre site. La page de retour reçoit (par la méthode GET)
// un 'authorization code'

// tests sur https://bastv.olympe.in/pweb2016/propose_connexion_g_php.php


$url_auth = "https://accounts.google.com/o/oauth2/v2/auth";
$id_client="22946272988-a3e2srpeacg8apvl36g5ii09sh4uea89.apps.googleusercontent.com";
$redirect="https://bastv.olympe.in/pweb2016/recoit_connexion_g_php.php";

$url = $url_auth."?"
	."response_type=code"
	."&client_id=".urlencode($id_client)
	."&redirect_uri=".urlencode($redirect)
	."&scope=profile";
	
echo "<a href='$url'>Conaiksion avècques gougueule</a>";
echo "<br>";
echo $url;

// à continuer
	


?>