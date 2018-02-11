<?php
require_once __DIR__ . '/vendor/autoload.php';

//define required fields
define("APPID",  'Enter-your-facebook-app-id');
define("APPSECRET",  'Enter-your-facebook-app-secret-key' );
define("FBPAGEID",  'Enter-any-facebook-Page-username-or-id' );

$fb = new Facebook\Facebook([ 
   'app_id' => APPID,
   'app_secret' => APPSECRET,
   'default_graph_version' => 'v2.12',
  ]);

//get access token
$accessToken = APPID."|".APPSECRET;
$fb->setDefaultAccessToken($accessToken);

/* PHP SDK v5.0.0 */
/* make the API call */
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/'.FBPAGEID.'/feed?fields=id,message,full_picture,created_time');
  $data=$response->getDecodedBody()['data'];
  
}

//handle exceptions 
  catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

//show returned data
foreach($data as $posts) {
    foreach ($posts as $key => $value) {
        if($key == 'full_picture') { echo '<img src="'.$value.'" width="100%" height="100%"/>'; }
        else { echo $value;}
  }
 }   


 ?>