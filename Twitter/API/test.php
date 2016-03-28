<?php
/*
 * Created on 28 mars 2016
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once('TwitterAPIExchange.php');
 $settings = array(
    'oauth_access_token' => "2431363132-coN7vEC2S8ZyzwdJ1fq1H16ArWIfvxhQhK2oA5T",
    'oauth_access_token_secret' => "Gvp4n0ARb2eERQh4OLoM1VfUQUs6XLjeruSHINBSfEOMg",
    'consumer_key' => "SACgZjWsF51pc7RyPzjHPzC0Z",
    'consumer_secret' => "NGifyj4VATEMxZLMn7idY28VG8wm0Ge56dEdNyxfZ2z4FatdTl"
);
$url = "https://api.twitter.com/1.1/statuses/update.json";
$requestMethod = "POST";
$postfields = array(
    'status' => 'Ceci est un test de message' ); 
    $twitter = new TwitterAPIExchange($settings);
    $twitter->setPostfields($postfields)
            ->buildOauth($url, $requestMethod)
            ->performRequest();
  
?>
