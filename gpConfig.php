<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '658156300635-v07u09fmqvia2fcaofvkus7ugb8pk0du.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'AIP3lx7R1gbGwwbTH7waK8KQ'; //Google client secret
$redirectURL = 'http://localhost/internship-job-experience/'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>