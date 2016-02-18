<!-- source :
 https://developers.google.com/identity/sign-in/web/devconsole-project
 * créer un "projet" sur https://console.developers.google.com pour choper un "ID client",
   configurer ("gestionnaire d'apis > identifiants") le nom et l'origine JS autorisées (domaine du site où
   se trouve la page de connexion) 
   ("URI de redirection autorisés" = pas utile avec le login JS)
     
   
--> 


<meta name="google-signin-client_id" content="22946272988-a3e2srpeacg8apvl36g5ii09sh4uea89.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>



<?php
	// client id
	//  22946272988-a3e2srpeacg8apvl36g5ii09sh4uea89.apps.googleusercontent.com 
?>

<div class="g-signin2" data-onsuccess="onSignIn"></div>

<script>
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
}
</script>


<!-- bouton et script pour se déconnecter -->
<a href="#" onclick="signOut();">Sign out</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
