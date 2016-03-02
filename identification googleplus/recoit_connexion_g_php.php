<?php
session_start();

set_include_path(get_include_path() . PATH_SEPARATOR . 'google-api-php-client-1.1.7/src');
require_once("google-api-php-client-1.1.7/src/Google/autoload.php");



// récupérer le client fait par la page de connexion via une variable de session ?



echo "Réponse de gogole :";
if(isset($_GET))
	var_dump($_GET); else echo "raté";

// en cas d'erreur, $_get['error'] contient le message d'erreur, sinon $_get['code'] contient le authorization code

// à suivre : https://developers.google.com/identity/protocols/OAuth2WebServer
// et https://developers.google.com/api-client-library/php/auth/web-app

echo "client existe :";
var_dump(isset($_SESSION['client']));


// "If your response endpoint renders an HTML page, any resources on that page will be able to see the authorization code
// in the URL. Scripts can read the URL directly, and all resources may be sent the URL in the Referer HTTP header.
//  Carefully consider if you want to send authorization credentials to all resources on that page. To avoid this issue,
// we recommend that the server first handle the request, then redirect to another URL that doesn't include the response
// parameters.

?>